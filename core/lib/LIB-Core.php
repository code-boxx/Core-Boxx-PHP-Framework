<?php
class CoreBoxx {
  // (A) PROPERTIES
  public $modules = []; // loaded modules
  public $error = "";   // error message, if any
  public $page = null;  // pagination data, if any
  public $mode = "C";   // operation mode - "a"pi "w"eb "c"li

  // (B) MODULES HANDLER
  // (B1) IS MODULE LOADED?
  //  $module : module to check
  function loaded ($module) { return isset($this->modules[$module]); }

  // (B2) LOAD MODULE
  //  $module : module to load
  function load ($module) : void {
    if ($this->loaded($module)) { return; }
    $file = PATH_LIB . "LIB-$module.php";
    if (file_exists($file)) {
      require $file;
      $this->modules[$module] = new $module($this);
    } else { throw new Exception("$module module not found!"); }
  }

  // (B3) "MAGIC LINK" TO MODULE
  function __get ($name) {
    if (isset($this->modules[$name])) { return $this->modules[$name]; }
  }

  // (C) FUNCTION MAPPING
  // (C1) AUTO MAP $_POST OR $_GET TO MODULE FUNCTION
  //  $module : module to load
  //  $function : function to run
  //  $mode : POST or GET
  function autoCall ($module, $function, $mode="POST") {
    // (C1-1) LOAD MODULE
    $this->load($module);

    // (C1-2) MAP POST OR GET?
    if ($mode=="POST") { $target =& $_POST; } else { $target =& $_GET; }

    // (C1-3) GET FUNCTION PARAMETERS
    $reflect = new ReflectionMethod($module, $function);
    $params = $reflect->getParameters();

    // (C1-4) EVIL MAPPING
    $evil = "\$results = \$this->$module->$function(";
    if (count($params)==0) { $evil .= ");"; }
    else {
      foreach ($params as $p) {
        // POST OR GET HAS EXACT PARAMETER MATCH
        if (isset($target[$p->name])) { $evil .= "\$_". $mode ."[\"". $p->name ."\"],"; }

        // USE DEFAULT VALUE
        else if ($p->isDefaultValueAvailable()) {
          $val = $p->getDefaultValue();
          if (is_string($val)) { $evil .= "\"$val\","; }
          else if (is_bool($val)) { $evil .= $val ? "true," : "false," ; }
          else { $evil .= ($val===null ? "null," : "$val,"); }
        }

        // NULL IF ALL ELSE FAILS
        else { $evil .= "null,"; }
      }
      $evil = substr($evil, 0, -1) . ");";
    }

    // (C1-5) EVIL RESULTS
    eval($evil);
    return $results;
  }
 
  // (C2) AUTO RESOLVE API REQUEST
  //  $actions : ["action" => ["module", "function"]]
  //  $mode : POST or GET
  function autoAPI ($actions, $mode="POST") : void {
    if (isset($actions[$this->Route->act])) {
      $result = $this->autoCall($actions[$this->Route->act][0], $actions[$this->Route->act][1], $mode);
      $this->respond(
        is_bool($result) ? $result : true, null,
        is_bool($result) ? null : $result,
        $this->DB->lastID!==null ? $this->DB->lastID : null
      );
    }
  }

  // (D) SYSTEM
  // (D1) STANDARD JSON RESPONSE
  //  $status : 1 or 0, true or false
  //  $msg : system message
  //  $data : optional, data append
  //  $more : optional, supplementary data
  //  $http : optional, HTTP response code (401, 403, 500, etc...)
  //  $exit : stop process, default true
  function respond ($status, $msg=null, $data=null, $more=null, $http=null, $exit=true) : void {
    if ($http!==null) { http_response_code($http); }
    if ($msg === null) {
      if ($status==1) { $msg = "OK"; }
      else { $msg = $this->error; }
    }
    echo json_encode([
      "status" => $status, "message" => $msg,
      "data" => $data, "more" => $more, "page" => $this->page
    ]);
    if ($exit) { exit(); }
  }

  // (D2) STANDARD ERROR HANDLER
  function ouch ($ex) : void {
    // (D2-1) SHOW HTML ERROR MESSAGE IN WEB MODE
    if ($this->mode=="W") { ?>
    <div style="box-sizing:border-box;position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:9999;background:#fff;color:#000;padding:30px;font-family:arial">
      <h1 style="font-size:50px;padding:0;margin:0">(╯°□°)╯︵ ┻━┻</h1>
      <p style="font-size:30px;color:#ff4545">AN ERROR HAS OCCURED.</p>
      <?php if (ERR_SHOW) { ?>
      <table>
        <tr><td style="font-weight:700">Message</td><td><?=$ex->getMessage()?></td></tr>
        <tr><td style="font-weight:700">Code</td><td><?=$ex->getCode()?></td></tr>
        <tr><td style="font-weight:700">File</td><td><?=$ex->getFile()?></td></tr>
        <tr><td style="font-weight:700">Line</td><td><?=$ex->getLine()?></td></tr>
        <tr><td style="font-weight:700">Trace</td><td><?=$ex->getTraceAsString()?></td></tr>
      </table>
      <?php } ?>
    </div>
    <?php }

    // (D2-2) OUTPUT JSON ENCODED MESSAGE OTHERWISE
    else {
      $this->respond(0,
      ERR_SHOW ? $ex->getMessage() : "OPPS! An error has occured.",
      ERR_SHOW ? [
        "code" => $ex->getCode(), "file" => $ex->getFile(),
        "line" => $ex->getLine(), "trace" => $ex->getTraceAsString()
      ] : null, null, 500);
    }
  }

  // (E) OTHER CONVENIENCE
  // (E1) GENERATE RANDOM STRING
  // $length : number of bytes
  function random ($length=8) { return bin2hex(random_bytes($length)); }

  // (E2) PAGINATION CALCULATOR
  //  $entries : total number of entries
  //  $now : current page
  function paginator ($entries, $now=1) : void {
    // (E2-1) TOTAL NUMBER OF PAGES
    $this->page = [
      "entries" => (int) $entries,
      "total" => ceil($entries / PAGE_PER)
    ];

    // (E2-2) CURRENT PAGE
    $this->page["now"] = $now > $this->page["total"] ? $this->page["total"] : $now ;
    if ($this->page["now"]<=0) { $this->page["now"] = 1; }
    $this->page["now"] = (int) $this->page["now"];

    // (E2-3) LIMIT X,Y
    $this->page["x"] = ($this->page["now"] - 1) * PAGE_PER;
    $this->page["y"] = PAGE_PER;
    $this->page["lim"] = " LIMIT {$this->page["x"]}, {$this->page["y"]}";
  }

  // (E3) REDIRECT
  function redirect ($page="", $url=HOST_BASE) : void {
    header("Location: $url$page");
    exit();
  }
}

// (F) ALL MODULES SHOULD EXTEND THIS CORE CLASS
class Core {
  // (F1) LINK MODULE TO CORE
  public $Core;
  public $error;
  function __construct ($core) {
    $this->Core =& $core;
    $this->error =& $core->error;
  }

  // (F2) MAKE MODULES LINKING EASIER
  function __get ($name) {
    if (isset($this->Core->modules[$name])) { return $this->Core->modules[$name]; }
  }
}

// (G) CORE OBJECT + GLOBAL ERROR HANDLING
$_CORE = new CoreBoxx();
function _CORERR ($ex) { global $_CORE; $_CORE->ouch($ex); }
set_exception_handler("_CORERR");