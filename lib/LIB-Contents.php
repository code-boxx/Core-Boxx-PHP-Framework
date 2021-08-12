<?php
class Contents extends Core {
  // (A) SAVE CONTENT
  function save ($title, $text, $id=null) {
    // (A1) ADD NEW
    $now = date("Y-m-d H:i:s");
    if ($id === null) {
      return $this->DB->insert("contents",
        ["content_title", "content_text", "date_created", "date_modified"],
        [$title, $text, $now, $now]
      );
    }
    // (A2) UPDATE
    else {
      return $this->DB->update("contents",
        ["content_title", "content_text", "date_modified"],
        "`content_id`=?",
        [$title, $text, $now, $id]
      );
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

  // (D) GET ALL CONTENTS (MINUS MAIN BODY)
  // @TODO - DO YOUR OWN PAGINATION!
  function getAll () {
    return $this->DB->fetchAll(
      "SELECT `content_id` ,`content_title`, `date_created`, `date_modified` FROM `contents`",
      null, "content_id"
    );
  }

  // (E) SEARCH CONTENTS
  function search ($search) {
    return $this->DB->fetchAll(
      "SELECT `content_id` ,`content_title`, `date_created`, `date_modified` FROM `contents` WHERE `content_title` LIKE ? OR `content_text` LIKE ?",
      ["%$search%", "%$search%"], "content_id"
    );
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
