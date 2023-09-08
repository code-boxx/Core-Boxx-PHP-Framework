<?php
// (A) FOR REGISTERED USERS ONLY
// @TODO - ENABLE THIS TO OPEN FOR REGISTERED USERS ONLY
// $_CORE->ucheck();

// (B) PAGE META
$_PMETA = ["load" => [
  ["l", HOST_ASSETS."PAGE-ai.css"],
  ["s", HOST_ASSETS."PAGE-ai.js", "defer"]
]];

// (C) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<script>const AIEP = "<?=HOST_CHATBOT?>";</script>
<div id="ai-wrap">
  <!-- (C1) CHAT HISTORY -->
  <div id="ai-chat"></div>

  <!-- (C2) QUERY -->
  <form id="ai-query" class="d-flex align-items-stretch head border p-2 w-100" onsubmit="return chat.send()">
    <input type="text" id="ai-txt" placeholder="Question" 
           class="form-control form-control-sm" autocomplete="off" required disabled>
    <button type="submit" id="ai-go" class="btn btn-primary p-3 ms-1 ico-sm icon-play3" disabled></button>
  </form>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>