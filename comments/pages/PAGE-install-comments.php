<?php
// (A) NEED USERS MODULE
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (B) IMPORT SQL
$_CORE->load("MInstall");
$_CORE->MInstall->sql("Comments");

// (C) CLEAN UP
$_CORE->MInstall->clean("comments");