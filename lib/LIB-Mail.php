<?php
class Mail extends Core {
  // (A) MAIL SETTINGS
  public $from = null;
  public $to = null;
  public $cc = null;
  public $bcc = null;
  public $subject = null;
  public $body = null;
  public $headers;

  // (B) BUILD PARTIAL HEADERS (SUPPORT FUNCTION)
  function head () {
    $this->headers = [
      "MIME-Version: 1.0",
      "Content-type: text/html; charset=utf-8"
    ];
    if ($this->from != null) { $this->headers[] = "From: $this->from"; }
  }

  // (C) SEND MAIL
  function send () {
    // (C1) INIT HEADERS
    $this->head();

    // (C2) CC + BCC
    if ($this->cc != null) {
      $this->headers[] = "Cc: " . (is_array($this->cc) ? implode(", ", $this->cc) : $this->cc);
    }
    if ($this->bcc != null) {
      $this->headers[] = "Bcc: " . (is_array($this->bcc) ? implode(", ", $this->bcc) : $this->bcc);
    }
    $this->headers = implode("\r\n", $this->headers);

    // (C3) SEND
    return mail(
      is_array($this->to) ? implode(", ", $this->to) : $this->to,
      $this->subject, $this->body, $this->headers
    );
  }

  // (D) SEND EMAIL (ONE BY ONE)
  // NOTE: CC + BCC WILL BE IGNORED
  function sendOne ($delay=1) {
    // (D1) INIT HEADERS
    $this->head();
    $this->headers = implode("\r\n", $this->headers);

    // (D2) SEND ONE-BY-ONE
    $pass = true;
    foreach ($this->to as $to) {
      if (!@mail($to, $this->subject, $this->body, $this->headers)) {
        $pass = false;
        break;
      }
      sleep($delay);
    }
    return $pass;
  }
}
