<?php
class Items extends Core {
  // (A) GET ALL ITEMS
  function getAll () {
    return $this->DB->fetchKV(
      "SELECT * FROM `items`", null, "item_id", "item_name"
    );
  }

  // (B) SAVE ITEM
  function save ($name, $id=null) : void {
    // (B1) DATA SETUP
    $fields = ["item_name"];
    $data = [$name];
    if ($id!=null) { $data[] = $id; }

    // (B2) INSERT OR UPDATE
    if ($id==null) { $this->DB->insert("items", $fields, $data); }
    else { $this->DB->update("items", $fields, "`item_id`=?", $data); }
  }

  // (C) DELETE ITEM
  function del ($id) : void {
    $this->DB->delete("items", "`item_id`=?", [$id]);
  }
}