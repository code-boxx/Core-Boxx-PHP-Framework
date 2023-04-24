<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h1>VAPID KEYS</h1>
<div class="my-3">
  Copy and paste the following keys into the <code>PUSH NOTIFICATION KEYS</code> section of <code>LIB/CORE-Config.php</code>.
</div>

<div class="bg-white border p-3 mb-3"><pre><?php
  require PATH_LIB . "webpush/autoload.php";
  print_r(Minishlink\WebPush\VAPID::createVapidKeys());
?></pre></div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>