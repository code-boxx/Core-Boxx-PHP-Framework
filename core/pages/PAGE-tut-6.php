<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="display-6 mb-4">VERY FAST TUTORIAL 6/6</div>

<div class="mb-1 fw-bold">
  Or add a new <code>pages/PAGE-items.php</code>
</div>
<pre class="mb-4 p-3 bg-dark text-white border"><code>&lt;?php
// (A) HTML TOP HALF
require PATH_PAGES . &quot;TEMPLATE-top.php&quot;;

// (B) YOUR CONTENT
$_CORE-&gt;load(&quot;items&quot;);

// (B1) GET ALL ITEMS
$items = $_CORE-&gt;items-&gt;getAll();
foreach ($items as $id=&gt;$name) { /* DRAW HTML */ }

// (B2) SAVE ITEM
$_CORE-&gt;items-&gt;save(&quot;ANOTHER&quot;);
$_CORE-&gt;items-&gt;save(&quot;ANOTHERZZ&quot;, 123);

// (B3) DELETE ITEM
$_CORE-&gt;items-&gt;del(456);

// (C) HTML BOTTOM HALF
require PATH_PAGES . &quot;TEMPLATE-bottom.php&quot;; ?&gt;
</code></pre>

<div class="mb-1 fw-bold">How this works:</div>
<ol class="list-group list-group-numbered mb-4">
  <li class="list-group-item"><code>http://site.com/foo/</code> will "map" to <code>pages/PAGE-foo.php</code></li>
  <li class="list-group-item"><code>http://site.com/foo/bar/</code> will "map" to <code>pages/PAGE-foo-bar.php</code></li>
  <li class="list-group-item">So, <code>http://site.com/items/</code> will "map" to <code>pages/PAGE-items.php</code></li>
  <li class="list-group-item">
    The default HTML template is using Bootstrap and Google Material Icons.
    No hard rules that you MUST use it.
    Feel free to redevelop the entire template to suit your needs.
  </li>
  <li class="list-group-item">Every page will have access to <code>$_CORE</code>, so you can use any module.</li>
</ol>

<div class="mb-1 fw-bold">The end! Dummy pages you can delete:</div>
<ul class="list-group mb-4">
  <li class="list-group-item"><code>pages/PAGE-tut-1~6.php</code></li>
  <li class="list-group-item"><code>pages/PAGE-demo.php</code></li>
  <li class="list-group-item"><code>pages/PAGE-about.php</code></li>
</ul>

<div class="mb-4">
  <a class="btn btn-danger" href="<?=HOST_BASE?>tut/5">Last Page</a>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>