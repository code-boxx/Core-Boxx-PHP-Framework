<?php
class Push extends Core {
  // (A) SAVE SUBSCRIBER
  function save ($endpoint, $sub) {
    $this->DB->replace("webpush", ["endpoint", "data"], [$endpoint, $sub]);
    return true;
  }

  // (B) REMOVE SUBSCRIBER
  function del ($endpoint) {
    $this->DB->delete("webpush", "`endpoint`=?", [$endpoint]);
    return true;
  }

  // (C) SEND PUSH
  function send ($title, $body, $icon=null, $image=null) {
    /* (C1) THIS SHOULD BE ADMIN-ONLY FUNCTION!
    global $_SESS;
    if (!isset($_SESS)) {
      $this->error = "No permission to send notifications.";
      return false;
    } */

    // (C2) LOAD WEB PUSH LIBRARY
    require PATH_LIB . "webpush/autoload.php";
    $push = new Minishlink\WebPush\WebPush(["VAPID" => [
      "subject" => EMAIL_FROM,
      "publicKey" => PUSH_PUBLIC,
      "privateKey" => PUSH_PRIVATE
    ]]);

    // (C3) SEND TO SUBSCRIBERS
    $this->DB->query("SELECT `data` FROM `webpush`");
    while ($r = $this->DB->stmt->fetchColumn()) {
      // (C3-1) SUBSCRIBER
      $sub = Minishlink\WebPush\Subscription::create(json_decode($r, true));

      // (C3-2) PUSH
      $result = $push->sendOneNotification($sub, json_encode([
        "title" => $title,
        "body" => $body,
        "icon" => $icon,
        "image" => $image
      ]));

      // (C3-3) RESULT
      if (!$result->isSuccess()) {
        $this->del($result->getRequest()->getUri()->__toString());
      }
    }

    // (C4) DONE
    return true;
  }
}