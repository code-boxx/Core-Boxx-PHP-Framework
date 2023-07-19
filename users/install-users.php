<?php
// (A) START CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-Go.php";

// (B) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-Users.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (C) ADD USER LEVEL TO CORE-CONFIG.PHP
if (!defined("USR_LVL")) {
  copy(PATH_LIB . "CORE-Config.php", PATH_LIB . "CORE-Config.old");
  try {
    $add = <<<EOD
    // ADDED BY INSTALLER - USER LEVELS
    define("USR_LVL", [
      "A" => "Admin", "U" => "User"
    ]);
    EOD;
    $fh = fopen(PATH_LIB . "CORE-Config.php", "a");
    fwrite($fh, "\r\n\r\n$add");
    fclose($fh);
  } catch (Exception $ex) {
    exit("Unable to update CORE-Config.php - " . $ex->getMessage());
  }
}

// (D) ADD SESSION HOOK TO SAVE ONLY USER ID
try {
  copy(PATH_LIB . "HOOK-SESS-Save.php", PATH_LIB . "HOOK-SESS-Save.old");
  $add = <<<EOD
  // ADDED BY INSTALLER - ONLY SAVE USER ID INTO JWT
  if (isset(\$data["user"])) {
    \$data["user"] = ["user_id" => \$data["user"]["user_id"]];
  }
  EOD;
  $fh = fopen(PATH_LIB . "HOOK-SESS-Save.php", "a");
  fwrite($fh, "\r\n\r\n$add");
  fclose($fh);
} catch (Exception $ex) {
  exit("Unable to update HOOK-SESS-Save.php - " . $ex->getMessage());
}

// (E) ADD SESSION HOOK TO LOAD USER FROM DATABASE
try {
  copy(PATH_LIB . "HOOK-SESS-Load.php", PATH_LIB . "HOOK-SESS-Load.old");
  $add = <<<EOD
  // ADDED BY INSTALLER - LOAD USER INFO INTO SESSION
  if (isset(\$_SESSION["user"])) {
    \$user = \$this->DB->fetch(
      "SELECT * FROM `users` WHERE `user_id`=?", [\$_SESSION["user"]["user_id"]]
    );
    if (is_array(\$user)) {
      unset(\$user["user_password"]);
      \$_SESSION["user"] = \$user;
    } else {
      \$this->destroy();
      throw new Exception("Invalid or expired session.");
    }
  }
  EOD;
  $fh = fopen(PATH_LIB . "HOOK-SESS-Load.php", "a");
  fwrite($fh, "\r\n\r\n$add");
  fclose($fh);
} catch (Exception $ex) {
  exit("Unable to update HOOK-SESS-Load.php - " . $ex->getMessage());
}

// (F) DELETE THIS SCRIPT
try {
  unlink(PATH_BASE . "install-users.php");
} catch (Exception $ex) {
  exit("Unable to delete install-users.php, please do so manually.");
}

// (G) DONE
echo "User module successfully installed.";