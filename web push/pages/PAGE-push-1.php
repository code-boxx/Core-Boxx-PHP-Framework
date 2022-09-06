<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h1>VAPID KEYS</h1>
<div class="my-3">
  Enable "PUSH NOTIFICATION KEYS" in <code>LIB/Code-Config.php</code>.
  Copy and paste the following keys in.
</div>

<div class="bg-white border p-3 mb-3"><pre><?php
  require PATH_LIB . "webpush/autoload.php";
  print_r(Minishlink\WebPush\VAPID::createVapidKeys());
?></pre></div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>