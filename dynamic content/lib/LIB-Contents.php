<?php
class Contents extends Core {
  // (A) SAVE CONTENT
  //  $title : title
  //  $text : body of content
  //  $id : content id, for editing only
  function save ($title, $text, $id=null) {
    // (A1) DATA SETUP
    $fields = ["content_title", "content_text"];
    $data = [$title, $text];
    if ($id!=null) {
      $fields[] = "date_modified";
      $data[] = date("Y-m-d H:i:s");
      $data[] = $id;
    }

    // (A2) ADD/UPDATE CONTENT
    if ($id == null) {
      $this->DB->insert("contents", $fields, $data);
    } else {
      $this->DB->update("contents", $fields, "`content_id`=?", $data);
    }
    return true;
  }

  // (B) DELETE CONTENT
  //  $id : content id
  function del ($id) {
    $this->DB->delete("contents", "`content_id`=?", [$id]);
    return true;
  }

  // (C) GET CONTENT
  function get ($id) {
    return $this->DB->fetch(
      "SELECT * FROM `contents` WHERE `content_id`=?", [$id]
    );
  }

  // (D) GET ALL CONTENTS (MINUS MAIN BODY)
  //  $search : search title or text (optional)
  //  $page : page number (optional)
  function getAll ($search=null, $page=null) {
    // (D1) PARITAL PRODUCT SQL + DATA
    $sql = "FROM `contents`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `content_title` LIKE ? OR `content_text` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }

    // (D2) PAGINATION
    if ($page != null) {
      $pgn = $this->core->paginator(
        $this->DB->fetchCol("SELECT COUNT(*) $sql", $data), $page
      );
      $sql .= " LIMIT {$pgn["x"]}, {$pgn["y"]}";
    }

    // (D3) RESULTS
    $content = $this->DB->fetchAll(
      "SELECT `content_id` ,`content_title`, `date_created`, `date_modified` $sql",
       $data, "content_id"
    );
    return $page != null
     ? ["data" => $content, "page" => $pgn]
     : $content ;
  }

  // (E) GENERATE STATIC FILE FROM CONTENT
  // @TODO - UP TO YOU, MAY BE USEFUL TO GENERATE STATIC HTML, MD, ETC...
  function toFile ($id) {
    $content = $this->get($id);
    ob_start();
    require PATH_PAGES . "TEMPLATE-top.php";
    echo $content["content_text"];
    require PATH_PAGES . "TEMPLATE-bottom.php";
    $fh = fopen(PATH_PAGES . "PAGE-generated.php", "w");
    fwrite($fh, ob_get_clean());
    fclose($fh);
    return true;
  }
}