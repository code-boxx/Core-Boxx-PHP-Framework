<?php
class Contents extends Core {
  // (A) SAVE CONTENT
  //  $slug : url slug
  //  $title : title
  //  $text : text content
  //  $id : content id, for editing only
  function save ($slug, $title, $text, $id=null) {
    // (A1) DATA SETUP
    $fields = ["content_slug", "content_title", "content_text"];
    $data = [$slug, $title, $text];
    if ($id!=null) {
      $fields[] = "date_modified";
      $data[] = date("Y-m-d H:i:s");
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
  //  $id : content id or slug
  function get ($id) {
    return $this->DB->fetch(
      sprintf(
        "SELECT * FROM `contents` WHERE `content_%s`=?",
        is_numeric($id) ? "id" : "slug"
      ), [$id]
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
      $this->Core->paginator(
        $this->DB->fetchCol("SELECT COUNT(*) $sql", $data), $page
      );
      $sql .= $this->Core->page["lim"];
    }

    // (D3) RESULTS
    return $this->DB->fetchAll(
      "SELECT `content_id` ,`content_title`, `date_created`, `date_modified` $sql",
       $data, "content_id"
    );
  }

  // (E) GENERATE STATIC FILE FROM CONTENT
  // @TODO - UP TO YOU, MAY BE USEFUL TO GENERATE STATIC HTML, MD, ETC...
  function toFile ($id) {
    // (E1) GET CONTENT
    $content = $this->get($id);
    if (!isset($content["content_text"])) { return false; }

    // (E2) GENERATE STATIC PAGE
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