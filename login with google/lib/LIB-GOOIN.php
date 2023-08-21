<?php
class GOOIN extends Core {
  // (A) CONSTRUCTOR
  private $goo;
  private $plen = 10; // random password will be 10 characters
  function __construct ($core) {
    // (A1) LINK WITH MODULES
    parent::__construct($core);

    // (A2) NEW GOOGLE CLIENT OBJECT
    require PATH_LIB . "GoogleAPI" . DIRECTORY_SEPARATOR . "autoload.php";
    $this->goo = new Google\Client();
    $this->goo->setAuthConfig(PATH_LIB . "CRD-Google.json");
    $this->goo->addScope("email");
    $this->goo->addScope("profile");
  }

  // (B) GET LOGIN URL
  function in () {
    return $this->goo->createAuthUrl();
  }

  // (C) PROCESS LOGIN OR REGISTRATION
  function go () {
    // (C1) UNPACK TOKEN
    try {
      $token = $this->goo->fetchAccessTokenWithAuthCode($_GET["code"]);
    } catch (Exception $ex) {
      $this->error = "Failed to fetch token from Google.";
      $this->goo->revokeToken();
      return;
    }

    // (C2) ERROR!
    if (isset($token["error"])) {
      $this->error = $token["error"];
      $this->goo->revokeToken();
      return;
    }

    // (C3) GET USER PROFILE FROM GOOGLE
    try {
      $this->goo->setAccessToken($token);
      $guser = (new Google_Service_Oauth2($this->goo))->userinfo->get();
      $this->goo->revokeToken();
    } catch (Exception $ex) {
      $this->error = "Failed to get user profile from Google.";
      $this->goo->revokeToken();
      return;
    }

    // (C4) USER HAS ALREADY TIED GOOGLE TO ACCOUNT - LOGIN
    $user = $this->get($guser["id"]);
    if (is_array($user)) { $this->login($user); }

    // (C5) HAS EXISTING ACCOUNT (EMAIL) - TIE TO ACCOUNT & LOGIN
    $this->Core->load("Users");
    $user = $this->Users->get($guser["email"]);
    if (is_array($user)) {
      $this->set($guser["id"], $user["user_id"]);
      $this->login($user);
    }

    // (C6) NEW USER REGISTRATION
    $password = $this->Core->random($this->plen);
    $this->Users->save(
      (str_replace(["\r", "\n"], "", $guser["givenName"]) . " " . str_replace(["\r", "\n"], "", $guser["familyName"])),
      $guser["email"], $password, "U"
    );
    $uid = $this->DB->lastID;
    $this->set($guser["id"], $uid);
    $this->Core->load("Mail");
    $this->Mail->send([
      "to" => $guser["email"],
      "subject" => "New Account Created",
      "template" => PATH_PAGES . "MAIL-gooin.php",
      "vars" => [
        "email" => $guser["email"],
        "password" => $password
      ]
    ]);
    $this->login($this->Users->get($uid));
  }

  // (D) GET USER BY GOOGLE ID
  function get ($id) {
    return $this->DB->fetch(
      "SELECT * FROM `users_hash` h
       LEFT JOIN `users` u USING (`user_id`)
       WHERE h.`hash_for`='GOO' AND h.`hash_code`=?", [$id]
    );
  }

  // (E) TIE GOOGLE ID TO ACCOUNT
  function set ($gid, $id) : void {
    $this->DB->replace(
      "users_hash", ["user_id", "hash_for", "hash_code", "hash_time"],
      [$id, "GOO", $gid, date("Y-m-d H:i:s")]
    );
  }

  // (F) LOGIN GIVEN USER - HELPER FOR GO(), NO VERIFICATION CHECKS
  function login ($user) {
    $_SESSION["user"] = $user;
    unset($_SESSION["user"]["user_password"]);
    $this->Session->save();
    $this->Core->redirect();
  }
}