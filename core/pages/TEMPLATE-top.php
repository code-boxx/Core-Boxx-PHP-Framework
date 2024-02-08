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
    <!-- @TODO <meta name="robots" content="noindex"> -->

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
    const cbhost={base:"<?=HOST_BASE?>",basepath:"<?=HOST_BASE_PATH?>",api:"<?=HOST_API_BASE?>",assets:"<?=HOST_ASSETS?>"},
    cbcache={n:"CBCACHE",s:<?=CACHE_VER?>,c:localStorage.getItem("CBCACHE") || 0};
    </script>
    <script src="<?=HOST_ASSETS?>PAGE-cbwork.js"></script>

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

    <!-- (C) MAIN NAV BAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top"><div class="container-fluid">
      <!-- (C1) MENU TOGGLE BUTTON -->
      <button class="navbar-toggler btn btn-sm text-white ico icon-menu" data-bs-toggle="collapse" data-bs-target="#cb-navbar"></button>

      <!-- (C2) COLLAPSABLE WRAPPER -->
      <div class="collapse navbar-collapse" id="cb-navbar">
        <!-- (C2-1) BRANDING LOGO -->
        <a class="navbar-brand" href="<?=HOST_BASE?>">
          <img src="<?=HOST_ASSETS?>favicon.png" loading="lazy" width="42" height="42">
        </a>

        <!-- (C2-2) LEFT MENU ITEMS -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="<?=HOST_BASE?>">PAGE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=HOST_BASE?>">PAGE</a>
          </li>
        </ul>
      </div>

      <!-- (C3) RIGHT ITEMS -->
      <div class="d-flex align-items-center">
        <!-- (C3-1) SWITCH TO ADMIN PANEL -->
        <?php if (defined("HOST_ADMIN") && isset($_SESSION["user"]) && $_SESSION["user"]["user_level"]=="A") { ?>
        <a class="text-decoration-none text-danger p-2 me-2 ico icon-shield" href="<?=HOST_ADMIN?>"></a>
        <?php } ?>

        <!-- (C3-2) NOTIFICATIONS -->
        <a class="text-decoration-none text-white p-2 me-1" href="<?=HOST_BASE?>notifications">
          <span class="ico icon-bell"></span>
          <span class="badge bg-danger rounded-pill">9</span>
        </a>

        <!-- (C3-3) USER -->
        <div class="dropdown">
          <div class="text-white ico icon-user p-2" role="button" data-bs-toggle="dropdown"></div>
          <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
            <?php if (isset($_SESSION["user"])) { ?>
            <li class="dropdown-header">
              <?=$_SESSION["user"]["user_name"]?><br>
              <?=$_SESSION["user"]["user_email"]?>
            </li>
            <li><a class="dropdown-item" href="<?=HOST_BASE?>myaccount">
              <i class="text-secondary ico-sm icon-briefcase"></i> My Account
            </a></li>
            <li class="dropdown-item text-warning" onclick="cb.bye()">
              <i class="ico-sm icon-exit"></i> Logout
            </li>
            <?php } else { ?>
            <li><a class="dropdown-item" href="<?=HOST_BASE?>login">
              <i class="text-secondary ico-sm icon-enter"></i> Login
            </a></li>
            <li><a class="dropdown-item" href="<?=HOST_BASE?>forgot">
              <i class="text-secondary ico-sm icon-question"></i> Forgot Password
            </a></li>
            <li><a class="dropdown-item" href="<?=HOST_BASE?>register">
              <i class="text-secondary ico-sm icon-pencil"></i> Register
            </a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div></nav>

    <!-- (D) MAIN PAGE -->
    <div class="container pt-4">
      <div id="cb-page-1">