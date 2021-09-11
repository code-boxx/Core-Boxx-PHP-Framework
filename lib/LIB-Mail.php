<?php
class Mail extends Core {
  // (A) MAIL SEND
  function send ($mail, $single=true) {
    // (A1) CHECKS
    $this->error = "";
    if (!isset($mail["to"])) { $this->error = "Mail to is not set"; }
    if (!isset($mail["subject"])) { $this->error = "Mail subject is not set"; }
    if (!isset($mail["body"])) { $this->error = "Mail body is not set"; }
    if (isset($mail["attach"])) {
      if (!is_array($mail["attach"])) { $mail["attach"] = [$mail["attach"]]; }
      foreach ($mail["attach"] as $f) { if (!file_exists($f)) {
        $this->error = "$f does not exist!";
        return false;
      }}
    }
    if ($this->error != "") { return false; }

    // (A2) BUILD MAIL HEADERS
    $boundary = isset($mail["attach"]) ? md5(time()) : null ;
    $headers = [
      "MIME-Version: 1.0",
      "Content-type: " . (isset($mail["attach"])
        ? "multipart/mixed; boundary=\"$boundary\""
        : "text/html; charset=utf-8")
    ];
    if (isset($mail["from"])) { $this->headers[] = "From: " . $mail["from"]; }
    if ($single && isset($mail["cc"])) {
      $headers[] = "Cc: " . (is_array($mail["cc"]) ? implode(", ", $mail["cc"]) : $mail["cc"]);
    }
    if ($single && isset($mail["bcc"])) {
      $headers[] = "Bcc: " . (is_array($mail["bcc"]) ? implode(", ", $mail["bcc"]) : $mail["bcc"]);
    }
    $headers = implode("\r\n", $headers);

    // (A3) MAIL ATTACHMENT
    if (isset($mail["attach"])) {
      // MAIL MESSAGE
      $mail["body"] = implode("\r\n", [
        "--$boundary",
        "Content-type: text/html; charset=utf-8",
        "", $mail["body"]
      ]);

      // MAIL ATTACHMENTS
      $attachments = count($mail["attach"]) - 1;
      for ($i=0; $i<=$attachments; $i++) {
        $mail["body"] .= implode("\r\n", [
          "", "--$boundary",
          'Content-Type: application/octet-stream; name="'.basename($mail["attach"][$i]).'"',
          "Content-Transfer-Encoding: base64",
          "Content-Disposition: attachment",
          "", chunk_split(base64_encode(file_get_contents($mail["attach"][$i]))),
          "--$boundary"
        ]);
        if ($i==$attachments) { $mail["body"] .= "--"; }
      }
    }

    // (A4) SEND TO EVERYONE IN A SINGLE EMAIL
    if ($single) {
      if (is_array($mail["to"])) { $mail["to"] = implode(", ", $mail["to"]); }
      if (@mail($mail["to"], $mail["subject"], $mail["body"], $headers)) { return true; }
      else {
        $this->error = "Error sending mail";
        return false;
      }
    }

    // (A5) SEND ONE-BY-ONE (CC BCC WILL BE IGNORED!)
    else {
      if (!is_array($mail["to"])) { $mail["to"] = [$mail["to"]]; }
      foreach ($mail["to"] as $to) {
        if (!@mail($to, $mail["subject"], $mail["body"], $headers)) {
          $this->error = "Failed to send to $to";
          return false;
        }
      }
    }
  }
}
