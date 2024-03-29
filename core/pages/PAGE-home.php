<?php
$_PMETA = ["title" => "Core Boxx Demo Page"];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) HEADER -->
<h1 class="mb-0">CORE BOXX</h1>
<div class="text-secondary mb-4"><small>
  open source modular php framework
</small></div>

<!-- (B) QUICKSTART -->
<h5 class="text-danger mb-2">
  <i class="ico-sm icon-power"></i> QUICKSTART
</h5>
<div class="bg-white border p-4 mb-4">
  <ul class="mb-0">
    <li><a href="https://code-boxx.com/core-boxx-php-framework/#sec-tut" target="_blank">
      Very Fast Tutorial
    </a></li>
    <li>
      Demo Pages - 
        <a href="<?=HOST_BASE?>demo/html" target="_blank">
          HTML Interface
        </a> |
        <a href="<?=HOST_BASE?>demo/transit" target="_blank">
          Page Transitions
        </a> | 
        <a href="<?=HOST_BASE?>demo/icomoon" target="_blank">
          Icons List
        </a> | 
        <a href="<?=HOST_BASE?>demo/php" target="_blank">
          PHP Variables
        </a>
    </li>
    <li><a href="<?=HOST_BASE?>demo/clean">
      Delete all demo files, give me a clean installation.
    </a></li>
  </ul>
</div>

<!-- (C) MORE @TODO -->
<h5 class="text-danger mb-2">
  <i class="ico-sm icon-search"></i> DIVE DEEPER
</h5>
<div class="bg-white border p-4 mb-4">
  <ul class="mb-0">
    <li><a href="https://code-boxx.com/core-boxx-core-library-reference/" target="_blank">
      Core Concepts
    </a></li>
    <li><a href="https://code-boxx.com/core-boxx-database-library-reference/" target="_blank">
      Database Module
    </a></li>
    <li><a href="https://code-boxx.com/core-boxx-route-library-reference/" target="_blank">
      URL Routes
    </a></li>
    <li><a href="https://code-boxx.com/core-boxx-session-library/" target="_blank">
      JWT Sessions
    </a></li>
  </ul>
</div>

<!-- (D) SUPPORT -->
<h5 class="text-danger mb-2">
  <i class="ico-sm icon-heart"></i> SUPPORT
</h5>
<div class="text-secondary mb-2"><small>
  * Help keep Core Boxx alive, even if it is just a little bit.
</small></div>
<div class="bg-white border p-4 mb-4">
  <a class="my-1 btn btn-danger d-flex-inline" href="https://www.paypal.com/paypalme/wstoh/5" target="_blank">
    <i class="ico-sm icon-mug"></i> Buy me a coffee
  </a>
  <a class="my-1 btn btn-danger d-flex-inline" href="https://github.com/sponsors/code-boxx" target="_blank">
    <i class="ico-sm icon-heart"></i> GitHub Sponsor
  </a>
  <a class="my-1 btn btn-danger d-flex-inline" href="https://payhip.com/codeboxx" target="_blank">
    <i class="ico-sm icon-cart"></i> Code Boxx Store
  </a>
</div>

<!-- (E) ALL OTHER LINKS -->
<h5 class="text-danger mb-2">
  <i class="ico-sm icon-sphere"></i> ALL THE LINKS
</h5>
<div class="bg-white border p-4 mb-4">
  <div class="fw-bold mb-2">CORE BOXX OFFICIAL</div>
  <ul class="mb-4">
    <li><a href="https://code-boxx.com/core-boxx-php-framework/#sec-faq" target="_blank">
      FAQ
    </a></li>
    <li><a href="https://github.com/code-boxx/Core-Boxx-PHP-Framework/issues/new/choose" target="_blank">
      Report a bug / Feature Request
    </a></li>
  </ul>

  <div class="fw-bold mb-2">SOCIALS</div>
  <ul class="mb-4">
    <li><a href="https://code-boxx.com/" target="_blank">Code Boxx</a></li>
    <li><a href="https://www.youtube.com/c/CodeBoxx" target="_blank">YouTube</a></li>
    <li><a href="https://www.pinterest.com/codeboxx/" target="_blank">Pinterest</a></li>
    <li><a href="https://www.facebook.com/real.code.boxx/" target="_blank">Facebook</a></li>
    <li><a href="https://github.com/code-boxx/" target="_blank">GitHub</a></li>
    <li><a href="https://codepen.io/code-boxx" target="_blank">CodePen</a></li>
  </ul>

  <div class="fw-bold mb-2">CREDITS / BUILT WITH</div>
  <ul class="mb-0">
    <li><a href="https://getbootstrap.com/" target="_blank">Bootstrap</a></li>
    <li><a href="https://icomoon.io/" target="_blank">IcoMoon</a></li>
    <li><a href="https://github.com/firebase/php-jwt" target="_blank">PHP JWT</a></li>
  </ul>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>