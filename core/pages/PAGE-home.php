<?php
$_PMETA = ["title" => "Core Boxx Demo Page"];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) HEADER -->
<h1 class="mb-0">CORE BOXX</h1>
<div class="text-secondary mb-4">open source modular php framework</div>
<img class="img-fluid d-block mx-auto mb-4" style="max-height:450px;" src="<?=HOST_ASSETS?>head-core-boxx.webp">

<!-- (B) HOW TO USE -->
<h5 class="text-danger">HOW TO USE CORE BOXX</h5>
<div class="bg-white border p-4 mb-4">
  <ul class="mb-0">
    <li><a href="<?=HOST_BASE?>demo/tut" target="_blank">
      <i class="ico-sm icon-magic-wand"></i> Very Fast Tutorial
    </a></li>
    <li><a href="<?=HOST_BASE?>demo/html" target="_blank">
      <i class="ico-sm icon-html-five"></i> HTML Interface Demo Page
    </a></li>
    <li><a href="<?=HOST_BASE?>demo/icomoon" target="_blank">
      <i class="ico-sm icon-star-full"></i> IcoMoon Icons List
    </a></li>
    <li><a href="<?=HOST_BASE?>demo/php" target="_blank">
      <i class="ico-sm icon-embed"></i> PHP Demo Page
    </a></li>
  </ul>
</div>

<!-- (C) MORE TUTORIALS -->
<h5 class="text-danger">DIVE DEEPER</h5>
<div class="bg-white border p-4 mb-4">
  <ul class="mb-0">
    <li><a href="https://code-boxx.com/core-boxx-core-library-reference/" target="_blank">
      <i class="ico-sm icon-cog"></i> Core Concepts
    </a></li>
    <li><a href="https://code-boxx.com/core-boxx-database-library-reference/" target="_blank">
      <i class="ico-sm icon-database"></i> Database Module
    </a></li>
    <li><a href="https://code-boxx.com/core-boxx-route-library-reference/" target="_blank">
      <i class="ico-sm icon-tree"></i> URL Routes
    </a></li>
    <li><a href="https://code-boxx.com/core-boxx-session-library/" target="_blank">
      <i class="ico-sm icon-cloud-check"></i> JWT Sessions
    </a></li>
  </ul>
</div>

<!-- (D) CLEAR -->
<h5 class="text-danger">NAH, I AM GOOD.</h5>
<div class="bg-white border p-4 mb-4">
  <a href="<?=HOST_BASE?>demo/clean">
    <i class="ico-sm icon-warning"></i> Delete all the demo files and give me a clean installation.
  </a>
</div>

<!-- (E) LINKS & CREDITS -->
<h5 class="text-danger">LINKS &AMP; CREDITS</h5>
<div class="bg-white border p-4 mb-4">
  <h6><i class="ico-sm icon-sphere"></i> Official</h6>
  <ul>
    <li><a href="https://code-boxx.com/core-boxx-php-framework/" target="_blank">Core Boxx Official Webpage</a></li>
    <li><a href="https://github.com/code-boxx/Core-Boxx" target="_blank">Core Boxx GitHub</a></li>
  </ul>

  <h6><i class="ico-sm icon-heart"></i> Support</h6>
  <ul>
    <li><a href="https://payhip.com/codeboxx" target="_blank">Code Boxx Store (Buy something to support us)</a></li>
    <li><a href="https://www.paypal.com/paypalme/wstoh/5" target="_blank">Donate (Feed a malnourished developer)</a></li>
  </ul>

  <h6><i class="ico-sm icon-smile2"></i> Socials</h6>
  <ul>
    <li><a href="https://code-boxx.com/" target="_blank">Code Boxx Webpage</a></li>
    <li><a href="https://www.youtube.com/c/CodeBoxx" target="_blank">YouTube</a></li>
    <li><a href="https://www.pinterest.com/codeboxx/" target="_blank">Pinterest</a></li>
    <li><a href="https://github.com/code-boxx/" target="_blank">GitHub</a></li>
    <li><a href="https://codepen.io/code-boxx" target="_blank">CodePen</a></li>
    <li><a href="https://dev.to/codeboxx" target="_blank">DEV</a></li>
  </ul>

  <h6><i class="ico-sm icon-hammer"></i> Built With</h6>
  <ul class="mb-0">
    <li><a href="https://getbootstrap.com/" target="_blank">Bootstrap</a></li>
    <li><a href="https://icomoon.io/" target="_blank">IcoMoon</a></li>
    <li><a href="https://github.com/firebase/php-jwt" target="_blank">PHP JWT</a></li>
  </ul>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>