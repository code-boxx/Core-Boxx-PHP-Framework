<?php
// (A) DUMMY SEARCH HANDLERS
switch ($_CORE->Route->act) {
  // (A1) USERS
  case "user":
    $all = ["Abby", "Abel", "Joe", "Jon", "Joy", "Yoda", "York"];
    $results = [];
    foreach ($all as $i=>$name) {
      if (str_contains(strtolower($name), strtolower($_POST["search"]))) {
        $results[] = ["n"=>$name];
      }
    }
    if (count($all) > SUGGEST_LIMIT) { array_splice($all, SUGGEST_LIMIT); }
    $_CORE->respond(1, "OK", $results);
    break;

  // (A2) ITEMS
  case "item":
    $all = [
      "SKU1" => "Apple",
      "SKU2" => "Appor",
      "SKU3" => "Grape",
      "SKU4" => "Grabe",
      "SKU5" => "Watermelon",
      "SKU6" => "Water"
    ];
    $results = [];
    foreach ($all as $sku=>$name) {
      if (str_contains(strtolower($name), strtolower($_POST["search"]))) {
        $results[] = ["n"=>$name, "v"=>$sku];
      }
    }
    if (count($all) > SUGGEST_LIMIT) { array_splice($all, SUGGEST_LIMIT); }
    $_CORE->respond(1, "OK", $results);
    break;
}

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);