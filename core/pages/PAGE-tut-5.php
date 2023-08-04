<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h1 class="mb-4">VERY FAST TUTORIAL 5/6</h1>

<h5 class="mb-2 text-danger">CREATE HTML PAGE</h5>
<div class="p-2 bg-primary text-white fw-bold">pages/PAGE-items.php</div>
<pre class="mb-2 p-3 bg-dark text-white border"><code>&lt;?php
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
<ol class="list-group list-group-numbered mb-4">
  <li class="list-group-item"><code>http://site.com/foo/</code> will "map" to <code>pages/PAGE-foo.php</code></li>
  <li class="list-group-item"><code>http://site.com/foo/bar/</code> will "map" to <code>pages/PAGE-foo-bar.php</code></li>
  <li class="list-group-item">So, <code>http://site.com/items/</code> will "map" to <code>pages/PAGE-items.php</code></li>
  <li class="list-group-item">Every page will have access to <code>$_CORE</code>, so you can use any module.</li>
</ol>

<h5 class="mb-2 text-danger">DEFAULT HTML TEMPLATE</h5>
<ol class="list-group list-group-numbered mb-4">
  <li class="list-group-item">
    The default HTML template is using Bootstrap and Google Material Icons.
  </li>
  <li class="list-group-item">
    No hard rules that you MUST use it.
  </li>
  <li class="list-group-item">
    Feel free to redevelop <code>TEMPLATE-top.php</code> and <code>TEMPLATE-bottom.php</code> to suit your needs.
  </li>
</ol>

<div class="mb-4">
  <a class="btn btn-danger" href="<?=HOST_BASE?>tut/4">Last Page</a>
  <a class="btn btn-primary" href="<?=HOST_BASE?>tut/6">Next Page</a>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>