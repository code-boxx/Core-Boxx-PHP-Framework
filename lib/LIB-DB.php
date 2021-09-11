<?php
class DB extends Core {
  // (A) PROPERTIES
  public $pdo = null; // PDO object
  public $stmt = null; // SQL statement

  // (B) CONSTRUCTOR - CONNECT TO DATABASE
  function __construct () {
    $this->connect();
  }

  // (C) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct () {
    if ($this->stmt!==null) { $this->stmt = null; }
    if ($this->pdo!==null) { $this->pdo = null; }
  }

  // (D) CONNECT TO DATABASE
  function connect () {
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]
    );
  }

  // (E) AUTO-COMMIT OFF
  function start () {
    $this->pdo->beginTransaction();
  }

  // (F) COMMIT OR ROLLBACK?
  function end ($pass=true) {
    if ($pass) { $this->pdo->commit(); }
    else { $this->pdo->rollBack(); }
  }

  // (G) EXECUTE SQL QUERY
  function query ($sql, $data=null) {
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
      return true;
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
  }

  // (H) FETCH ALL (MULTIPLE ROWS)
  function fetchAll ($sql, $data=null, $key=null) {
    $this->query($sql, $data);
    if ($key === null) { return $this->stmt->fetchAll(); }
    else {
      $data = [];
      while ($row = $this->stmt->fetch()) { $data[$row[$key]] = $row; }
      return $data;
    }
  }

  // (I) FETCH (SINGLE ROW)
  function fetch ($sql, $data=null) {
    $this->query($sql, $data);
    return $this->stmt->fetch();
  }

  // (J) FETCH (SINGLE COLUMN)
  function fetchCol ($sql, $data=null) {
    $this->query($sql, $data);
    return $this->stmt->fetchColumn();
  }

  // (K) INSERT OR REPLACE SQL HELPER
  function insert ($table, $fields, $data, $replace=false) {
    // (K1) QUICK CHECK
    $cfields = count($fields);
    $cdata = count($data);
    $segments = $cdata / $cfields;
    if (is_float($segments)) {
      $this->error = "Number of data elements do not match with number of fields";
      return false;
    }

    // (K2) FORM SQL
    $sql = $replace ? "REPLACE" : "INSERT" ;
    $sql .= " INTO `$table` (";
    foreach ($fields as $f) { $sql .= "`$f`,"; }
    $sql = substr($sql, 0, -1).") VALUES ";
    $sql .= str_repeat("(". substr(str_repeat("?,", $cfields), 0, -1) ."),", $segments);
    $sql = substr($sql, 0, -1).";";

    // (K3) RUN QUERY
    return $this->query($sql, $data);
  }

  // (L) UPDATE SQL HELPER
  function update ($table, $fields, $where, $data) {
    $sql = "UPDATE `$table` SET ";
    foreach ($fields as $f) { $sql .= "`$f`=?,"; }
    $sql = substr($sql, 0, -1) . " WHERE $where";
    return $this->query($sql, $data);
  }
}
