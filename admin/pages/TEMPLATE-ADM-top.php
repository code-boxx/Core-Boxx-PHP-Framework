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

    <!-- (A4) SERVICE WORKER + HOST -->
    <script>
    if ("serviceWorker" in navigator) { navigator.serviceWorker.register("<?=HOST_BASE?>CB-worker.js", {scope: "<?=HOST_BASE_PATH?>"}); }
    var cbhost={base:"<?=HOST_BASE?>",basepath:"<?=HOST_BASE_PATH?>",admin:"<?=HOST_ADMIN?>",api:"<?=HOST_API_BASE?>",assets:"<?=HOST_ASSETS?>"};
    </script>

    <!-- (A5) LIBRARIES & SCRIPTS -->
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="<?=HOST_ASSETS?>bootstrap.min.css">
    <link rel="stylesheet" href="<?=HOST_ASSETS?>PAGE-cb.css">
    <script defer src="<?=HOST_ASSETS?>bootstrap.bundle.min.js"></script>
    <script defer src="<?=HOST_ASSETS?>PAGE-cb.js"></script>

    <!-- (A6) ADDITIONAL SCRIPTS -->
    <?php if (isset($_PMETA["load"])) { foreach ($_PMETA["load"] as $load) {
      if ($load[0]=="s") {
        printf("<script src='%s'%s></script>", $load[1], isset($load[2]) ? " ".$load[2] : "");
      } else {
        printf("<link rel='stylesheet' href='%s'>", $load[1]);
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
            <i class="text-secondary ico-sm icon-link"></i> Link
          </a>
          <a class="nav-link ms-1" href="<?=HOST_ADMIN?>">
            <i class="text-secondary ico-sm icon-link"></i> Link
          </a>
          <hr>
        </li>
        <li class="nav-item">
          <div class="my-2 fw-bold">System</div>
          <a class="nav-link ms-1" href="<?=HOST_ADMIN?>users">
            <i class="text-secondary ico-sm icon-users"></i> Users
          </a>
          <a class="nav-link ms-1" href="<?=HOST_ADMIN?>settings">
            <i class="text-secondary ico-sm icon-cog"></i> Settings
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