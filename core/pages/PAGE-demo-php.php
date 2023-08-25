<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h1 class="mb-0">COMMON PHP VARIABLES</h1>
<div class="text-secondary mb-3">a quick walkthrough of the common php variables</div>

<!-- (A) CORE ENGINE -->
<h5 class="text-danger mb-2">THE CORE ENGINE</h5>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-2"><code><?php print_r($_CORE); ?></code></pre>
<div class="bg-white border p-4 mb-4">
  <ul class="mb-0">
    <li>Every page has access to the core engine <code>$_CORE</code>.</li>
    <li>Load modules - <code>$_CORE->load("MODULE")</code></li>
    <li>Get data - <code>$items = $_CORE->MODULE->getAll()</code></li>
    <li>Use it to do whatever is required.</li>
  </ul>
</div>

<!-- (B) URL PATH -->
<h5 class="text-danger mb-2">CURRENT PATH</h5>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-2"><code><?php echo $_CORE->Route->path; ?></code></pre>
<div class="bg-white border p-4 mb-4">
  <ul class="mb-0">
    <li><code>$_CORE->Route->path</code> - The current path.</li>
    <li>You can use this to resolve things like pagination <code>page/123/</code>,</li>
    <li>or maybe a selected category <code>products/toys/</code>.</li>
  </ul>
</div>

<!-- (C) SESSION -->
<h5 class="text-danger mb-2">SESSION DATA</h5>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-2"><code><?php print_r($_SESSION); ?></code></pre>
<div class="bg-white border p-4 mb-4">
  <ul class="mb-0">
    <li><code>$_SESSION</code> - Session variables.</li>
    <li><strong>TAKE NOTE - Core Boxx is not using PHP <code>session_start()</code>!</strong></li>
    <li>It's best to follow up with the <a href="https://code-boxx.com/core-boxx-session-library/" target="_blank">session module documentation</a>.</li>
  </ul>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>