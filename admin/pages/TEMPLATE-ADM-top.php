<!DOCTYPE html>
<html>
  <head>
    <!-- (A) HEAD -->
    <!-- (A1) TITLE, DESC, CHARSET, VIEWPORT -->
    <title><?=isset($_PMETA["title"])?$_PMETA["title"]:SITE_NAME?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?=isset($_PMETA["desc"])?$_PMETA["desc"]:SITE_NAME?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
    <meta name="view-transition" content="same-origin">
    <meta name="robots" content="noindex">

    <!-- (A2) WEB APP & ICONS -->
    <link rel="icon" href="<?=HOST_ASSETS?>favicon.png" type="image/png">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="white">
    <link rel="apple-touch-icon" href="<?=HOST_ASSETS?>icon-512.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?=SITE_NAME?>">
    <meta name="msapplication-TileImage" content="<?=HOST_ASSETS?>icon-512.png">
    <meta name="msapplication-TileColor" content="#ffffff">

    <!-- (A3) WEB APP MANIFEST -->
    <!-- https://web.dev/add-manifest/ -->
    <link rel="manifest" href="<?=HOST_BASE?>CB-manifest.json">

    <!-- (A4) SERVICE WORKER -->
    <script>if ("serviceWorker" in navigator) {
      navigator.serviceWorker.register("<?=HOST_BASE?>CB-worker.js", {scope: "<?=HOST_BASE_PATH?>"});
    }</script>

    <!-- (A5) LIBRARIES & SCRIPTS -->
    <!-- https://getbootstrap.com/ -->
    <!-- https://fonts.google.com/icons -->
    <link rel="stylesheet" href="<?=HOST_ASSETS?>bootstrap.min.css">
    <script defer src="<?=HOST_ASSETS?>bootstrap.bundle.min.js"></script>
    <style>
    ::view-transition-old(root),::view-transition-new(root){animation-duration:0.3s}
    @keyframes grow-x{from{transform:scaleX(0)}to{transform:scaleX(1)}}@keyframes shrink-x{from{transform:scaleX(1)}to{transform:scaleX(0)}}::view-transition-old(tx){animation:.3s linear both shrink-x}::view-transition-new(tx){animation:.23s linear both grow-x}.tran-x{view-transition-name:tx}
    @keyframes grow-y{from{transform:scaleY(0)}to{transform:scaleY(1)}}@keyframes shrink-y{from{transform:scaleY(1)}to{transform:scaleY(0)}}::view-transition-old(ty){animation:.3s linear both shrink-y}::view-transition-new(ty){animation:.23s linear both grow-y}.tran-y{view-transition-name:ty}
    @keyframes zoom-in{from{transform:scale(0)}to{transform:scale(1)}}@keyframes zoom-out{from{transform:scale(1)}to{transform:scale(0)}}::view-transition-old(zoom){animation:.3s linear both zoom-out}::view-transition-new(zoom){animation:.3s linear both zoom-in}.tran-zoom{view-transition-name:zoom}
    @font-face{font-family:icomoon;src:url(<?=HOST_ASSETS?>icomoon.woff) format('woff');font-weight:400;font-style:normal;font-display:block}[class*=" icon-"],[class^=icon-]{font-family:icomoon!important;font-style:normal;font-weight:400;font-variant:normal;text-transform:none;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
    .icon-home3:before{content:"\e902"}.icon-pencil:before{content:"\e905"}.icon-image:before{content:"\e90d"}.icon-images:before{content:"\e90e"}.icon-camera:before{content:"\e90f"}.icon-headphones:before{content:"\e910"}.icon-music:before{content:"\e911"}.icon-play:before{content:"\e912"}.icon-dice:before{content:"\e915"}.icon-bullhorn:before{content:"\e91a"}.icon-connection:before{content:"\e91b"}.icon-feed:before{content:"\e91d"}.icon-mic:before{content:"\e91e"}.icon-file-empty:before{content:"\e924"}.icon-files-empty:before{content:"\e925"}.icon-file-text2:before{content:"\e926"}.icon-file-zip:before{content:"\e92b"}.icon-copy:before{content:"\e92c"}.icon-paste:before{content:"\e92d"}.icon-stack:before{content:"\e92e"}.icon-folder:before{content:"\e92f"}.icon-folder-open:before{content:"\e930"}.icon-folder-plus:before{content:"\e931"}.icon-folder-minus:before{content:"\e932"}.icon-folder-download:before{content:"\e933"}.icon-folder-upload:before{content:"\e934"}.icon-price-tag:before{content:"\e935"}.icon-barcode:before{content:"\e937"}.icon-qrcode:before{content:"\e938"}.icon-cart:before{content:"\e93a"}.icon-coin-dollar:before{content:"\e93b"}.icon-credit-card:before{content:"\e93f"}.icon-phone:before{content:"\e942"}.icon-address-book:before{content:"\e944"}.icon-envelop:before{content:"\e945"}.icon-pushpin:before{content:"\e946"}.icon-location:before{content:"\e947"}.icon-map:before{content:"\e94b"}.icon-history:before{content:"\e94d"}.icon-clock2:before{content:"\e94f"}.icon-alarm:before{content:"\e950"}.icon-bell:before{content:"\e951"}.icon-calendar:before{content:"\e953"}.icon-printer:before{content:"\e954"}.icon-keyboard:before{content:"\e955"}.icon-display:before{content:"\e956"}.icon-laptop:before{content:"\e957"}.icon-mobile:before{content:"\e958"}.icon-tablet:before{content:"\e95a"}.icon-floppy-disk:before{content:"\e962"}.icon-drive:before{content:"\e963"}.icon-database:before{content:"\e964"}.icon-undo:before{content:"\e965"}.icon-redo:before{content:"\e966"}.icon-undo2:before{content:"\e967"}.icon-redo2:before{content:"\e968"}.icon-forward:before{content:"\e969"}.icon-reply:before{content:"\e96a"}.icon-bubble:before{content:"\e96b"}.icon-user:before{content:"\e971"}.icon-users:before{content:"\e972"}.icon-user-plus:before{content:"\e973"}.icon-user-minus:before{content:"\e974"}.icon-user-check:before{content:"\e975"}.icon-quotes-left:before{content:"\e977"}.icon-quotes-right:before{content:"\e978"}.icon-hour-glass:before{content:"\e979"}.icon-spinner:before{content:"\e97a"}.icon-spinner11:before{content:"\e984"}.icon-search:before{content:"\e986"}.icon-zoom-in:before{content:"\e987"}.icon-zoom-out:before{content:"\e988"}.icon-enlarge:before{content:"\e989"}.icon-shrink:before{content:"\e98a"}.icon-enlarge2:before{content:"\e98b"}.icon-shrink2:before{content:"\e98c"}.icon-key:before{content:"\e98d"}.icon-lock:before{content:"\e98f"}.icon-unlocked:before{content:"\e990"}.icon-wrench:before{content:"\e991"}.icon-equalizer:before{content:"\e992"}.icon-cog:before{content:"\e994"}.icon-hammer:before{content:"\e996"}.icon-magic-wand:before{content:"\e997"}.icon-bug:before{content:"\e999"}.icon-pie-chart:before{content:"\e99a"}.icon-stats-dots:before{content:"\e99b"}.icon-stats-bars2:before{content:"\e99d"}.icon-gift:before{content:"\e99f"}.icon-glass:before{content:"\e9a0"}.icon-mug:before{content:"\e9a2"}.icon-rocket:before{content:"\e9a5"}.icon-meter:before{content:"\e9a6"}.icon-hammer2:before{content:"\e9a8"}.icon-fire:before{content:"\e9a9"}.icon-bin2:before{content:"\e9ad"}.icon-briefcase:before{content:"\e9ae"}.icon-airplane:before{content:"\e9af"}.icon-truck:before{content:"\e9b0"}.icon-shield:before{content:"\e9b4"}.icon-power:before{content:"\e9b5"}.icon-switch:before{content:"\e9b6"}.icon-power-cord:before{content:"\e9b7"}.icon-clipboard:before{content:"\e9b8"}.icon-list-numbered:before{content:"\e9b9"}.icon-list:before{content:"\e9ba"}.icon-list2:before{content:"\e9bb"}.icon-tree:before{content:"\e9bc"}.icon-menu:before{content:"\e9bd"}.icon-menu2:before{content:"\e9be"}.icon-cloud:before{content:"\e9c1"}.icon-cloud-download:before{content:"\e9c2"}.icon-cloud-upload:before{content:"\e9c3"}.icon-cloud-check:before{content:"\e9c4"}.icon-download2:before{content:"\e9c5"}.icon-upload2:before{content:"\e9c6"}.icon-download3:before{content:"\e9c7"}.icon-upload3:before{content:"\e9c8"}.icon-sphere:before{content:"\e9c9"}.icon-earth:before{content:"\e9ca"}.icon-link:before{content:"\e9cb"}.icon-flag:before{content:"\e9cc"}.icon-attachment:before{content:"\e9cd"}.icon-eye:before{content:"\e9ce"}.icon-eye-plus:before{content:"\e9cf"}.icon-eye-minus:before{content:"\e9d0"}.icon-eye-blocked:before{content:"\e9d1"}.icon-bookmark:before{content:"\e9d2"}.icon-star-empty:before{content:"\e9d7"}.icon-star-half:before{content:"\e9d8"}.icon-star-full:before{content:"\e9d9"}.icon-heart:before{content:"\e9da"}.icon-heart-broken:before{content:"\e9db"}.icon-smile2:before{content:"\e9e2"}.icon-sad2:before{content:"\e9e6"}.icon-warning:before{content:"\ea07"}.icon-notification:before{content:"\ea08"}.icon-question:before{content:"\ea09"}.icon-plus:before{content:"\ea0a"}.icon-minus:before{content:"\ea0b"}.icon-info:before{content:"\ea0c"}.icon-cancel-circle:before{content:"\ea0d"}.icon-blocked:before{content:"\ea0e"}.icon-cross:before{content:"\ea0f"}.icon-checkmark:before{content:"\ea10"}.icon-enter:before{content:"\ea13"}.icon-exit:before{content:"\ea14"}.icon-play3:before{content:"\ea1c"}.icon-pause2:before{content:"\ea1d"}.icon-stop2:before{content:"\ea1e"}.icon-backward2:before{content:"\ea1f"}.icon-forward3:before{content:"\ea20"}.icon-first:before{content:"\ea21"}.icon-last:before{content:"\ea22"}.icon-previous2:before{content:"\ea23"}.icon-next2:before{content:"\ea24"}.icon-eject:before{content:"\ea25"}.icon-volume-high:before{content:"\ea26"}.icon-volume-medium:before{content:"\ea27"}.icon-volume-low:before{content:"\ea28"}.icon-volume-mute:before{content:"\ea29"}.icon-volume-mute2:before{content:"\ea2a"}.icon-volume-increase:before{content:"\ea2b"}.icon-volume-decrease:before{content:"\ea2c"}.icon-loop:before{content:"\ea2d"}.icon-loop2:before{content:"\ea2e"}.icon-arrow-up:before{content:"\ea32"}.icon-arrow-right:before{content:"\ea34"}.icon-arrow-down:before{content:"\ea36"}.icon-arrow-left:before{content:"\ea38"}.icon-circle-up:before{content:"\ea41"}.icon-circle-right:before{content:"\ea42"}.icon-circle-down:before{content:"\ea43"}.icon-circle-left:before{content:"\ea44"}.icon-move-up:before{content:"\ea46"}.icon-move-down:before{content:"\ea47"}.icon-sort-alpha-asc:before{content:"\ea48"}.icon-sort-alpha-desc:before{content:"\ea49"}.icon-sort-numeric-asc:before{content:"\ea4a"}.icon-sort-numberic-desc:before{content:"\ea4b"}.icon-sort-amount-asc:before{content:"\ea4c"}.icon-sort-amount-desc:before{content:"\ea4d"}.icon-checkbox-checked:before{content:"\ea52"}.icon-checkbox-unchecked:before{content:"\ea53"}.icon-radio-checked:before{content:"\ea54"}.icon-radio-checked2:before{content:"\ea55"}.icon-radio-unchecked:before{content:"\ea56"}.icon-make-group:before{content:"\ea58"}.icon-scissors:before{content:"\ea5a"}.icon-filter:before{content:"\ea5b"}.icon-table2:before{content:"\ea71"}.icon-insert-template:before{content:"\ea72"}.icon-embed:before{content:"\ea7f"}.icon-embed2:before{content:"\ea80"}.icon-terminal:before{content:"\ea81"}.icon-share2:before{content:"\ea82"}.icon-google:before{content:"\ea88"}.icon-facebook:before{content:"\ea90"}.icon-youtube:before{content:"\ea9d"}.icon-github:before{content:"\eab0"}.icon-pinterest:before{content:"\ead1"}.icon-paypal:before{content:"\ead8"}.icon-file-pdf:before{content:"\eadf"}.icon-file-word:before{content:"\eae1"}.icon-file-excel:before{content:"\eae2"}.icon-libreoffice:before{content:"\eae3"}.icon-html-five:before{content:"\eae4"}
    .ico{font-size:24px}.ico-sm{font-size:16px}
    #cb-loading{transition:opacity .3s}.cb-hide{opacity:0;visibility:hidden;height:0}.cb-pg-hide{display:none}
    #cb-loading{width:100vw;height:100vh;position:fixed;top:0;left:0;z-index:999;background:rgba(0,0,0,.7)}#cb-loading .spinner-border{width:80px;height:80px}
    .head{background:#ddd}.zebra .d-flex{background:#fff;margin-bottom:10px}.zebra .d-flex:nth-child(odd){background-color:#f1f1f1}.pagination{border:1px solid #d0e8ff;background:#f0f8ff}
    #cb-body,body{min-height:100vh}#cb-toggle{display:none}#cb-side{width:155px;flex-shrink:0}#cb-side a{color:#fff}#cb-side .mi{color:#6a6a6a}@media screen and (max-width:768px){#cb-toggle{display:block}#cb-side{display:none}#cb-side.show{display:block}}
    </style>
    <script>var cbhost={base:"<?=HOST_BASE?>",basepath:"<?=HOST_BASE_PATH?>",admin:"<?=HOST_ADMIN?>",api:"<?=HOST_API_BASE?>",assets:"<?=HOST_ASSETS?>"};</script>
    <script defer src="<?=HOST_ASSETS?>PAGE-cb.js"></script>

    <!-- (A6) ADDITIONAL SCRIPTS -->
    <?php if (isset($_PMETA["load"])) { foreach ($_PMETA["load"] as $load) {
      if ($load[0]=="s") {
        printf("<script src='%s'%s></script>", $load[1], isset($load[2]) ? " ".$load[2] : "");
      } else {
        printf("<link rel='stylesheet' href='%s'>", $load[1], isset($load[2]) ? " ".$load[2] : "");
      }
    }}
    if (isset($_PMETA)) { unset($_PMETA); } ?>
  </head>
  <body class="bg-light">
    <!-- (B) COMMON SHARED INTERFACE -->
    <!-- (B1) NOW LOADING -->
    <div id="cb-loading" class="d-flex justify-content-center align-items-center cb-hide">
      <div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- (B2) TOAST MESSAGE -->
    <div class="position-fixed top-50 start-50 translate-middle" style="z-index:11">
      <div id="cb-toast" class="toast hide" role="alert">
        <div class="toast-header">
          <span id="cb-toast-icon"></span>
          <strong id="cb-toast-head" class="me-auto p-1"></strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div id="cb-toast-body" class="toast-body bg-light"></div>
      </div>
    </div>

    <!-- (B3) MODAL DIALOG BOX -->
    <div id="cb-modal" class="modal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">
      <div class="modal-header">
        <h5 id="cb-modal-head" class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div id="cb-modal-body" class="modal-body"></div>
      <div id="cb-modal-foot" class="modal-footer">
      </div>
    </div></div></div>

    <!-- (C) MAIN INTERFACE -->
    <div id="cb-body" class="d-flex">
      <!-- (C1) LEFT SIDEBAR -->
      <nav id="cb-side" class="bg-dark text-white p-2"><ul class="navbar-nav">
        <li class="nav-item">
          <img src="<?=HOST_ASSETS?>favicon.png" loading="lazy" width="42" height="42">
          <hr>
          <div class="mb-2 fw-bold">Section</div>
          <a class="nav-link ms-1" href="<?=HOST_ADMIN?>">
            <i class="me-1 text-secondary ico-sm icon-link"></i> Link
          </a>
          <a class="nav-link ms-1" href="<?=HOST_ADMIN?>">
            <i class="me-1 text-secondary ico-sm icon-link"></i> Link
          </a>
          <hr>
        </li>
        <li class="nav-item">
          <div class="my-2 fw-bold">System</div>
          <a class="nav-link ms-1" href="<?=HOST_ADMIN?>users">
            <i class="me-1 text-secondary ico-sm icon-users"></i> Users
          </a>
          <a class="nav-link ms-1" href="<?=HOST_ADMIN?>settings">
            <i class="me-1 text-secondary ico-sm icon-cog"></i> Settings
          </a>
          <hr>
        </li>
      </ul></nav>

      <!-- (C2) RIGHT CONTENTS -->
      <div class="flex-grow-1">
        <!-- (C2-1) TOP NAV -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark"><div class="container-fluid">
          <button id="cb-toggle" class="navbar-toggler btn btn-sm text-white ico icon-menu" onclick="cb.toggle()"></button>

          <div class="navbar-nav me-auto mb-2 mb-lg-0"></div>

          <div class="d-flex align-items-center">
            <a class="text-decoration-none text-primary p-2 me-3 ico icon-home3" href="<?=HOST_BASE?>"></a>
            <div class="dropdown">
              <div class="text-white ico icon-user p-2" role="button" data-bs-toggle="dropdown"></div>
              <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                <li class="dropdown-header">
                  <?=$_SESSION["user"]["user_name"]?><br>
                  <?=$_SESSION["user"]["user_email"]?>
                </li>
                <li class="dropdown-item text-warning" onclick="cb.bye()">
                  <i class="ico-sm icon-exit"></i> Logout
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <!-- (C2-2) CONTENTS -->
        <div class="p-4">
          <div id="cb-page-1">