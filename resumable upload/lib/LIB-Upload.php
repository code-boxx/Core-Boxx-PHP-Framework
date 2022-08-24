<?php
class Upload extends Core {
  // (A) UPLOAD FOLDERS
  // @TODO - SET YOUR OWN!
  private $upTemp = PATH_BASE . "temp" . DIRECTORY_SEPARATOR;
  private $upDest = PATH_BASE . "uploads" . DIRECTORY_SEPARATOR;

  // (B) CONSTRUCTOR - CREATE UPLOAD FOLDERS
  function __construct ($core) {
    parent::__construct($core);
    if (!file_exists($this->upTemp)) { mkdir($this->upTemp); }
    if (!file_exists($this->upDest)) { mkdir($this->upDest); }
  }

  // (C) RECEIVE FILE
  // @TODO - THIS IS VERY BASIC!
  // do your own security checks and processes.
  // for example, only registered users can upload.
  // each registered user has their own folder, upload quota, etc...
  function recv () {
    // (C1) INIT FLOW
    require PATH_LIB . "flow" . DIRECTORY_SEPARATOR . "autoload.php";
    $config = new \Flow\Config();
    $config->setTempDir($this->upTemp);
    $file = new \Flow\File($config);
    $request = new \Flow\Request();

    // (C2) HANDLE UPLOAD
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
      if ($file->checkChunk()) { header("HTTP/1.1 200 Ok"); }
      else { header("HTTP/1.1 204 No Content"); exit(); }
    } else {
      if ($file->validateChunk()) { $file->saveChunk(); }
      else { header("HTTP/1.1 400 Bad Request"); exit(); }
    }
    $upFile = $this->upDest . $request->getFileName();
    if ($file->validateFile() && $file->save($upFile)) {
      // UPLOAD COMPLETE
    } else {
      // NOT LAST CHUNK - CONTINUE
    }
  }

  // (D) FLUSH TEMP FOLDER
  // CREDITS : https://stackoverflow.com/questions/3349753/delete-directory-with-files-in-it
  // @TODO - PROTECT THIS FUNCTION!
  function flush () {
    $it = new RecursiveDirectoryIterator($this->upTemp, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
    foreach($files as $file) {
      if ($file->isDir()) { rmdir($file->getRealPath()); }
      else { unlink($file->getRealPath()); }
    }
    return true;
  }
}