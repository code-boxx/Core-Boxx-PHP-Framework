<?php
class DB extends Core {
  // (A) PROPERTIES
  public $pdo = null; // pdo object
  public $stmt = null; // sql statement
  public $lastID = null; // last insert id
  public $lastRows = 0; // last affected rows

  // (B) CONSTRUCTOR - CONNECT TO DATABASE
  function __construct ($core) {
    parent::__construct($core);
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  // (C) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct () {
    if ($this->stmt!==null) { $this->stmt = null; }
    if ($this->pdo!==null) { $this->pdo = null; }
  }

  // (D) AUTO-COMMIT OFF
  function start () { $this->pdo->beginTransaction(); }

  // (E) COMMIT OR ROLLBACK?
  //  $pass : commit or rollback?
  function end ($pass=true) {
    if ($pass) { $this->pdo->commit(); }
    else { $this->pdo->rollBack(); }
  }

  // (F) EXECUTE SQL QUERY
  //  $sql : sql query
  //  $data : array of parameters for query
  // * simply throws exception on sql error, no return results.
  function query ($sql, $data=null) {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
    // @TODO
    $this->lastRows = $this->stmt->rowCount();
  }

  // (G) FETCH ALL (MULTIPLE ROWS)
  //  $sql : SQL query
  //  $data : array of parameters for query
  //  $key : optional, use this field as the array key
  //  * returns null if no results
  function fetchAll ($sql, $data=null, $key=null) {
    $this->query($sql, $data);
    if ($key === null) { $results = $this->stmt->fetchAll(); }
    else {
      $results = [];
      while ($row = $this->stmt->fetch()) { $results[$row[$key]] = $row; }
    }
    return count($results)>0 ? $results : null ;
  }

  // (H) FETCH (SINGLE ROW)
  //  $sql : SQL query
  //  $data : array of parameters for query
  //  * returns null if no results
  function fetch ($sql, $data=null) {
    $this->query($sql, $data);
    $result = $this->stmt->fetch();
    return $result==false ? null : $result ;
  }

  // (I) FETCH (SINGLE COLUMN)
  //  $sql : SQL query
  //  $data : array of parameters for query
  //  * returns null if no results
  function fetchCol ($sql, $data=null) {
    $this->query($sql, $data);
    $result = $this->stmt->fetchColumn();
    return $result==false ? null : $result ;
  }

  // (J) INSERT OR REPLACE SQL HELPER
  //  $table : table to insert into
  //  $fields : array of fields to insert
  //  $data : data array to insert
  //  $replace : replace instead of insert?
  function insert ($table, $fields, $data, $replace=false) {
    // (J1) QUICK CHECK
    $cfields = count($fields);
    $cdata = count($data);
    $segments = $cdata / $cfields;
    if (is_float($segments)) {
      throw new Exception("Number of data elements do not match with number of fields");
    }

    // (J2) FORM SQL
    $sql = $replace ? "REPLACE" : "INSERT" ;
    $sql .= " INTO `$table` (";
    foreach ($fields as $f) { $sql .= "`$f`,"; }
    $sql = substr($sql, 0, -1).") VALUES ";
    $sql .= str_repeat("(". substr(str_repeat("?,", $cfields), 0, -1) ."),", $segments);
    $sql = substr($sql, 0, -1).";";

    // (J3) RUN QUERY
    $this->query($sql, $data);
    if (!$replace) { $this->lastID = $this->pdo->lastInsertId(); }
    return true;
  }

  // (K) UPDATE SQL HELPER
  //  $table : table to update
  //  $fields : array of fields to update
  //  $where : where clause for update SQL
  //  $data : data array to update
  function update ($table, $fields, $where, $data) {
    $sql = "UPDATE `$table` SET ";
    foreach ($fields as $f) { $sql .= "`$f`=?,"; }
    $sql = substr($sql, 0, -1) . " WHERE $where";
    $this->query($sql, $data);
    return true;
  }
}
