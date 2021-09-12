<?php
// @TODO -
// As these are "admin functions", you will want to protect these properly
// I.E. Set a user system in place, allow signed in users to change
// https://code-boxx.com/core-boxx-users-module/
// if (!isset($_SESSION["user"])) { exit("NOPE"); }

switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request");
    break;

  // (B) SAVE MENU
  case "save":
    $_CORE->autoAPI("Menu", "save");
    break;

  // (C) SAVE MENU ITEMS
  case "saveItems":
    $_POST["items"] = json_decode($_POST["items"]);
    $_CORE->autoAPI("Menu", "saveItems");
    break;

  // (D) DELETE MENU
  case "del":
    $_CORE->autoAPI("Menu", "del");
    break;

  // (E) GET MENU
  case "get":
    $_CORE->autoGETAPI("Menu", "get");
    break;

  // (F) GET ALL MENUS
  case "getAll":
    $_CORE->autoGETAPI("Menu", "getAll");
    break;

  // (G) GET MENU ITEMS
  case "getItems":
    $_CORE->autoGETAPI("Menu", "getItems");
    break;
}
