<?php
class Content extends Core {
  // (A) SAVE CONTENT
  function save ($content, $id=null) {
    if ($id===null) {
      $this->DB->insert("content", ["content"], [$content]);
    } else {
      $this->DB->update("content", ["content"], "`id`=?", [$content, $id]);
    }
    return true;
  }

  // (B) GET ALL CONTENT
  function getAll () {
    return $this->DB->fetchAll("SELECT * FROM `content`");
  }
}
