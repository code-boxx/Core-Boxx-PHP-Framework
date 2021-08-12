<?php
class Menu extends Core {
  // (A) SAVE MENU
   function save ($name, $desc, $id=null) {
    // (A1) ADD MENU
    if ($id===null) {
      return $this->DB->insert("menu",
        ["menu_name", "menu_desc"],
        [$name, $desc]
      );
    }
    // (A2) UPDATE MENU
    else {
      return $this->DB->update("menu",
        ["menu_name", "menu_desc"],
        "`menu_id`=?",
        [$name, $desc, $id]
      );
    }
  }

  // (B) SAVE MENU ITEMS
  function saveItems ($id, $items=null) {
    // (B1) DELETE OLD ITEMS
    $this->DB->start();
    $pass = $this->DB->query(
      "DELETE FROM `menu_items` WHERE `menu_id`=?", [$id]
    );

    // (B2) SAVE ITEMS
    if (is_array($items)) {
      $data = [];
      foreach ($items as $i) {
        $data[] = $id;
        $data = array_merge($data, $i);
      }
      $pass = $this->DB->insert("menu_items",
        ["menu_id", "item_id", "parent_id", "item_label", "item_link", "item_target"],
        $data
      );
    }

    // (B3) RESULTS
    $this->DB->end($pass);
    // @TODO - Recommended to generate flat HTML
    // $this->toHTML($id);
    return $pass;
  }

  // (C) DELETE ENTIRE MENU
  function del ($id) {
    // (C1) DELETE ITEMS
    $this->DB->start();
    $pass = $this->DB->query("DELETE FROM `menu_items` WHERE `menu_id`=?", [$id]);

    // (C2) DELETE MAIN
    if ($pass) { $pass = $this->DB->query("DELETE FROM `menu` WHERE `menu_id`=?", [$id]); }

    // (C3) RESULT
    $this->DB->end($pass);
    return $pass;
  }

  // (D) GET MENU
  function get ($id) {
    return $this->DB->fetch(
      "SELECT * FROM `menu` WHERE `menu_id`=?", [$id]
    );
  }

  // (E) GET ALL MENUS
  // @TODO - DO YOUR OWN PAGINATION!
  function getAll () {
    return $this->DB->fetchAll("SELECT * FROM `menu`", null, "menu_id");
  }

  // (F) GET MENU ITEMS
  function getItems ($id) {
    // (F1) FLAGS
    $items = []; // Menu items
    $children = []; // Children & their parent IDs

    // (F2) GET ALL MENU ITEMS
    $this->DB->query("SELECT * FROM `menu_items` WHERE `menu_id`=?", [$id]);
    while ($row = $this->DB->stmt->fetch()) {
      // CHILD MENU ITEM
      if (isset($row['parent_id'])) {
        $thisItem = $row['item_id'];
        $thisParent = $row['parent_id'];
        $children[$thisItem] = $thisParent;
        $thisSlot = ""; $first = true;
        while ($thisParent !== null) {
          if ($first) {
            $thisSlot = "[$thisParent]['children'][$thisItem]";
            $first = false;
          } else {
            $thisSlot = "[$thisParent]['children']" . $thisSlot;
          }
          $thisItem = $thisParent;
          $thisParent = isset($children[$thisItem]) ? $children[$thisItem] : null ;
        }
        eval("\$slot = &\$items$thisSlot;");
      }

      // ROOT LEVEL MENU ITEM
      else { $slot = &$items[$row['item_id']]; }

      // ASSIGN DATA
      $slot = [
        "label" => $row['item_label'],
        "link" => $row['item_link'],
        "target" => $row['item_target'],
        "children" => []
      ];
    }
    return $items;
  }

  // @TODO -
  // (G) GENERATE STATIC HTML FILE FOR MENU (AFTER SAVE)
  // This is optional but highly recommended.
  // Loading static HTML is faster than the database. I.E. require "menu.html";
  // But you need to complete your own HTML...
  function toHTML ($id) {
    // (G1) HELPER FUNCTION
    function writer($fh, $menu){
      fwrite($fh, "<ul>");
      foreach ($menu as $i=>$item) {
        fwrite($fh, "<li><a href='{$item['link']}'>{$item['label']}</a>");
        if (count($item['children']) > 0) { writer($fh, $item['children']); }
        fwrite($fh, "</li>");
      }
      fwrite($fh, "</ul>");
    }

    // (G2) CREATE HTML FILE
    $fh = fopen("menu-$id.html", "w");
    writer($fh, $this->getItems($id));
    fclose($fh);
  }
}
