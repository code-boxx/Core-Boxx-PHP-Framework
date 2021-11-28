<?php
// @TODO - THIS IS VERY BASIC!
// Do your own security checks and processes.
// For example, only registered users can upload.
// Each registered user has their own folder, upload quota, etc...

// (A) UPLOAD FILE PATHS
$upTemp = PATH_BASE . "temp" . DIRECTORY_SEPARATOR;
$upDest = PATH_BASE . "uploads" . DIRECTORY_SEPARATOR;
if (!file_exists($upTemp)) { mkdir($upTemp); }
if (!file_exists($upDest)) { mkdir($upDest); }
switch ($_REQ) {
  // (B) BAD REQUEST
  default:
    $_CORE->respond(0, "Invalid request");
    break;

  // (C) RECIEVE UPLOAD
  case "recv":
    // (C1) INIT FLOW
    require PATH_BASE . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
    $config = new \Flow\Config();
    $config->setTempDir($upTemp);
    $file = new \Flow\File($config);
    $request = new \Flow\Request();

    // (C2) HANDLE UPLOAD
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if ($file->checkChunk()) { header("HTTP/1.1 200 Ok"); }
      else { header("HTTP/1.1 204 No Content"); exit(); }
    } else {
      if ($file->validateChunk()) { $file->saveChunk(); }
      else { header("HTTP/1.1 400 Bad Request"); exit(); }
    }
    $upFile = $upDest . $request->getFileName();
    if ($file->validateFile() && $file->save($upFile)) {
      // UPLOAD COMPLETE
    } else {
      // NOT LAST CHUNK - CONTINUE
    }
    break;

  // (D) FLUSH TEMP FOLDER
  // @TODO - PROTECT THIS FUNCTION!
  case "flush":
    if ($_POST['confirm']!="KEEP-CALM-AND-FLUSH") {
      $_CORE->respond(0, "No permission");
      exit();
    }

    // CREDITS : https://stackoverflow.com/questions/3349753/delete-directory-with-files-in-it
    $it = new RecursiveDirectoryIterator($upTemp, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
    foreach($files as $file) {
      if ($file->isDir()){
        rmdir($file->getRealPath());
      } else {
        unlink($file->getRealPath());
      }
    }
    $_CORE->respond(1, "$upTemp has been flushed.");
    break;
}
