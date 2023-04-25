<?php
// (A) NO PERMISSION - REDIRECT TO LOGIN PAGE
if (!isset($_CORE->Session->data["user"])) { $_CORE->redirect("login/"); }
 
// (B) STRIP "ADMIN/" FROM PATH
$_CORE->Route->path = substr($_CORE->Route->path, 6);

// (C) OK - LOAD PAGE
$_CORE->Route->load($_CORE->Route->path==""
  ? "ADM-home.php"
  : "ADM-" . str_replace("/", "-", rtrim($_CORE->Route->path, "/\\")) . ".php"
);