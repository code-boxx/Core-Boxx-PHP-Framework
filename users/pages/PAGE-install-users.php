<?php
// (A) IMPORT SQL
$_CORE->load("MInstall");
$_CORE->MInstall->sql("Users");

// (B) ADD USER LEVEL TO CORE-CONFIG.PHP
$_CORE->MInstall->append(
  PATH_LIB . "CORE-Config.php",
  "\r\n\r\n" . <<<EOD
  // ADDED BY INSTALLER - USER LEVELS
  define("USR_LVL", [
    "A" => "Admin", "U" => "User", "S" => "Suspended"
  ]);
  EOD
);

// (C) ADD SESSION HOOK TO ONLY SAVE USER ID
$_CORE->MInstall->append(
  PATH_LIB . "HOOK-SESS-Save.php",
  "\r\n\r\n" . <<<EOD
  // ADDED BY INSTALLER - ONLY SAVE USER ID INTO JWT
  if (isset(\$data["user"])) {
    \$data["user"] = ["user_id" => \$data["user"]["user_id"]];
  }
  EOD
);

// (D) ADD SESSION HOOK TO LOAD USER FROM DATABASE
$_CORE->MInstall->append(
  PATH_LIB . "HOOK-SESS-Load.php",
  "\r\n\r\n" . <<<EOD
  // ADDED BY INSTALLER - LOAD USER INFO INTO SESSION
  if (isset(\$_SESSION["user"])) {
    \$user = \$this->DB->fetch(
      "SELECT * FROM `users` WHERE `user_id`=?",
      [\$_SESSION["user"]["user_id"]]
    );
    if (!is_array(\$user) || (isset(\$user["user_level"]) && \$user["user_level"]=="S")) {
      \$this->destroy();
      throw new Exception("Invalid or expired session.");
    } else {
      unset(\$user["user_password"]);
      \$_SESSION["user"] = \$user;
    }
  }
  EOD
);

// (E) CLEAN UP
$_CORE->MInstall->clean("users");