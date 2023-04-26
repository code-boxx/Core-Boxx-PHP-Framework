<?php
// (A) ADMIN ONLY
$_CORE->ucheck("A");
 
// (B) STRIP "ADMIN/" FROM PATH
$_CORE->Route->path = substr($_CORE->Route->path, 6);

// (C) OK - LOAD PAGE
$_CORE->Route->load($_CORE->Route->path==""
  ? "ADM-home.php"
  : "ADM-" . str_replace("/", "-", rtrim($_CORE->Route->path, "/\\")) . ".php"
);