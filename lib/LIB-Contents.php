<?php
class Contents extends Core {
  // (A) SAVE CONTENT
  function save ($title, $text, $id=null) {
    // (A1) DATA SETUP
    $now = date("Y-m-d H:i:s");
    $fields = $id === null
      ? ["content_title", "content_text", "date_created", "date_modified"]
      : ["content_title", "content_text", "date_modified"] ;
    $data = $id === null
      ? [$title, $text, $now, $now]
      : [$title, $text, $now, $id] ;

    // (A2) ADD NEW
    if ($id === null) {
      return $this->DB->insert("contents", $fields, $data);
    }

    // (A3) UPDATE
    else {
      return $this->DB->update("contents", $fields, "`content_id`=?", $data);
    }
  }

  // (B) DELETE CONTENT
  function del ($id) {
    return $this->DB->query(
      "DELETE FROM `contents` WHERE `content_id`=?", [$id]
    );
  }

  // (C) GET CONTENT
  function get ($id) {
    return $this->DB->fetch(
      "SELECT * FROM `contents` WHERE `content_id`=?", [$id]
    );
  }

  // (D) COUNT CONTENT ENTRIES (FOR PAGINATION)
  function count ($search=null) {
    $sql = "SELECT COUNT(*) FROM `contents`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `content_title` LIKE ? OR `content_text` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }
    return $this->DB->fetchCol($sql, $data);
  }

  // (E) GET ALL CONTENTS (MINUS MAIN BODY)
  function getAll ($search=null, $page=1) {
    // (E1) PAGINATION
    $entries = $this->count($search);
    $pgn = $this->core->paginator($entries, $page);

    // (E2) CONTENT ENTRIES
    $sql = "SELECT `content_id` ,`content_title`, `date_created`, `date_modified` FROM `contents`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `content_title` LIKE ? OR `content_text` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }
    $sql .= " LIMIT {$pgn['x']}, {$pgn['y']}";
    return [
      "data" => $this->DB->fetchAll($sql, $data, "content_id"),
      "page" => $pgn
    ];
  }

  // (F) HELPER - SAVE CONTENT TO STATIC FILE
  // @TODO - UP TO YOU, MAY BE USEFUL TO GENERATE STATIC HTML, MD, ETC...
  function toFile ($id) {
    $content = $this->get($id);
    $fh = fopen("output.txt", "w");
    fwrite($fh, $content['content_text']);
    fclose($fh);
    return true;
  }
}
