<h5 class="text-danger mb-2">CREATE HTML PAGE</h5>
<div class="p-2 bg-dark text-white fw-bold">pages/PAGE-items.php</div>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-2"><code>&lt;?php
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

<div class="bg-white border p-4 mb-4"><ol class="mb-0">
  <li><code>http://site.com/foo/</code> will "map" to <code>pages/PAGE-foo.php</code></li>
  <li><code>http://site.com/foo/bar/</code> will "map" to <code>pages/PAGE-foo-bar.php</code></li>
  <li>So, <code>http://site.com/items/</code> will "map" to <code>pages/PAGE-items.php</code></li>
  <li>Every page will have access to <code>$_CORE</code>, so you can use any module.</li>
</ol></div>

<h5 class="text-danger mb-2">DEFAULT HTML TEMPLATE</h5>
<div class="bg-white border p-4 mb-4"><ol class="mb-0">
  <li>The default HTML template is using Bootstrap and IcoMoon.</li>
  <li>No hard rules that you MUST use it.</li>
  <li>Feel free to redevelop <code>TEMPLATE-top.php</code> and <code>TEMPLATE-bottom.php</code> to suit your needs.</li>
  <li>To make things easy, there is an empty page template - <code>pages/PAGE-empty.php</code></li>
</ol></div>

<div class="mb-4">
  <button type="button" class="my-1 btn btn-danger d-flex-inline" onclick="tut(4)"> 
    <i class="ico-sm icon-arrow-left"></i> Last Page
  </button>
  <button type="button" class="my-1 btn btn-primary d-flex-inline" onclick="tut(6)"> 
    Next Page <i class="ico-sm icon-arrow-right"></i>
  </button>
</div>