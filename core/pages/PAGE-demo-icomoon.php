<?php
$_PMETA = ["title" => "IcoMoon List"];
require PATH_PAGES . "TEMPLATE-top.php";

/* (X) EXTRACT LIST FROM CSS
$all = file(PATH_BASE . "style.css");
foreach ($all as $l) {
  $bf = strpos($l, ":before");
  if ($bf !== false) {
    $css = substr($l, 1, $bf-1);
    file_put_contents("test.html", sprintf('<div><i class="%s"></i> %s</div>', $css, $css), FILE_APPEND);
    file_put_contents("test.html", "\r\n", FILE_APPEND);
  }
}*/ ?>
<!-- (A) HEADER -->
<h1 class="mb-0">ICOMOON ICONS LIST</h1>
<div class="text-secondary mb-3">for your convenience</div>
<style>
#moonlist {
  display : grid;
  grid-template-columns : repeat(2, 1fr);
  grid-gap: 10px;
  font-size: 24px;
}
#moonlist div {
  padding: 10px;
  border: 1px solid #eee;
  background: #fff;
}
</style>

<div id="moonlist" class="mb-3">
  <div><i class="icon-home3"></i> icon-home3</div>
  <div><i class="icon-pencil"></i> icon-pencil</div>
  <div><i class="icon-image"></i> icon-image</div>
  <div><i class="icon-images"></i> icon-images</div>
  <div><i class="icon-camera"></i> icon-camera</div>
  <div><i class="icon-headphones"></i> icon-headphones</div>
  <div><i class="icon-music"></i> icon-music</div>
  <div><i class="icon-play"></i> icon-play</div>
  <div><i class="icon-dice"></i> icon-dice</div>
  <div><i class="icon-bullhorn"></i> icon-bullhorn</div>
  <div><i class="icon-connection"></i> icon-connection</div>
  <div><i class="icon-feed"></i> icon-feed</div>
  <div><i class="icon-mic"></i> icon-mic</div>
  <div><i class="icon-file-empty"></i> icon-file-empty</div>
  <div><i class="icon-files-empty"></i> icon-files-empty</div>
  <div><i class="icon-file-text2"></i> icon-file-text2</div>
  <div><i class="icon-file-zip"></i> icon-file-zip</div>
  <div><i class="icon-copy"></i> icon-copy</div>
  <div><i class="icon-paste"></i> icon-paste</div>
  <div><i class="icon-stack"></i> icon-stack</div>
  <div><i class="icon-folder"></i> icon-folder</div>
  <div><i class="icon-folder-open"></i> icon-folder-open</div>
  <div><i class="icon-folder-plus"></i> icon-folder-plus</div>
  <div><i class="icon-folder-minus"></i> icon-folder-minus</div>
  <div><i class="icon-folder-download"></i> icon-folder-download</div>
  <div><i class="icon-folder-upload"></i> icon-folder-upload</div>
  <div><i class="icon-price-tag"></i> icon-price-tag</div>
  <div><i class="icon-barcode"></i> icon-barcode</div>
  <div><i class="icon-qrcode"></i> icon-qrcode</div>
  <div><i class="icon-cart"></i> icon-cart</div>
  <div><i class="icon-coin-dollar"></i> icon-coin-dollar</div>
  <div><i class="icon-credit-card"></i> icon-credit-card</div>
  <div><i class="icon-phone"></i> icon-phone</div>
  <div><i class="icon-address-book"></i> icon-address-book</div>
  <div><i class="icon-envelop"></i> icon-envelop</div>
  <div><i class="icon-pushpin"></i> icon-pushpin</div>
  <div><i class="icon-location"></i> icon-location</div>
  <div><i class="icon-map"></i> icon-map</div>
  <div><i class="icon-history"></i> icon-history</div>
  <div><i class="icon-clock2"></i> icon-clock2</div>
  <div><i class="icon-alarm"></i> icon-alarm</div>
  <div><i class="icon-bell"></i> icon-bell</div>
  <div><i class="icon-calendar"></i> icon-calendar</div>
  <div><i class="icon-printer"></i> icon-printer</div>
  <div><i class="icon-keyboard"></i> icon-keyboard</div>
  <div><i class="icon-display"></i> icon-display</div>
  <div><i class="icon-laptop"></i> icon-laptop</div>
  <div><i class="icon-mobile"></i> icon-mobile</div>
  <div><i class="icon-tablet"></i> icon-tablet</div>
  <div><i class="icon-floppy-disk"></i> icon-floppy-disk</div>
  <div><i class="icon-database"></i> icon-database</div>
  <div><i class="icon-undo"></i> icon-undo</div>
  <div><i class="icon-redo"></i> icon-redo</div>
  <div><i class="icon-undo2"></i> icon-undo2</div>
  <div><i class="icon-redo2"></i> icon-redo2</div>
  <div><i class="icon-forward"></i> icon-forward</div>
  <div><i class="icon-reply"></i> icon-reply</div>
  <div><i class="icon-bubble"></i> icon-bubble</div>
  <div><i class="icon-user"></i> icon-user</div>
  <div><i class="icon-users"></i> icon-users</div>
  <div><i class="icon-user-plus"></i> icon-user-plus</div>
  <div><i class="icon-user-minus"></i> icon-user-minus</div>
  <div><i class="icon-user-check"></i> icon-user-check</div>
  <div><i class="icon-quotes-left"></i> icon-quotes-left</div>
  <div><i class="icon-quotes-right"></i> icon-quotes-right</div>
  <div><i class="icon-hour-glass"></i> icon-hour-glass</div>
  <div><i class="icon-spinner"></i> icon-spinner</div>
  <div><i class="icon-spinner11"></i> icon-spinner11</div>
  <div><i class="icon-search"></i> icon-search</div>
  <div><i class="icon-zoom-in"></i> icon-zoom-in</div>
  <div><i class="icon-zoom-out"></i> icon-zoom-out</div>
  <div><i class="icon-enlarge"></i> icon-enlarge</div>
  <div><i class="icon-shrink"></i> icon-shrink</div>
  <div><i class="icon-enlarge2"></i> icon-enlarge2</div>
  <div><i class="icon-shrink2"></i> icon-shrink2</div>
  <div><i class="icon-key"></i> icon-key</div>
  <div><i class="icon-lock"></i> icon-lock</div>
  <div><i class="icon-unlocked"></i> icon-unlocked</div>
  <div><i class="icon-wrench"></i> icon-wrench</div>
  <div><i class="icon-equalizer"></i> icon-equalizer</div>
  <div><i class="icon-cog"></i> icon-cog</div>
  <div><i class="icon-hammer"></i> icon-hammer</div>
  <div><i class="icon-magic-wand"></i> icon-magic-wand</div>
  <div><i class="icon-bug"></i> icon-bug</div>
  <div><i class="icon-pie-chart"></i> icon-pie-chart</div>
  <div><i class="icon-stats-dots"></i> icon-stats-dots</div>
  <div><i class="icon-stats-bars2"></i> icon-stats-bars2</div>
  <div><i class="icon-gift"></i> icon-gift</div>
  <div><i class="icon-glass"></i> icon-glass</div>
  <div><i class="icon-mug"></i> icon-mug</div>
  <div><i class="icon-rocket"></i> icon-rocket</div>
  <div><i class="icon-meter"></i> icon-meter</div>
  <div><i class="icon-hammer2"></i> icon-hammer2</div>
  <div><i class="icon-fire"></i> icon-fire</div>
  <div><i class="icon-bin2"></i> icon-bin2</div>
  <div><i class="icon-briefcase"></i> icon-briefcase</div>
  <div><i class="icon-airplane"></i> icon-airplane</div>
  <div><i class="icon-truck"></i> icon-truck</div>
  <div><i class="icon-shield"></i> icon-shield</div>
  <div><i class="icon-power"></i> icon-power</div>
  <div><i class="icon-switch"></i> icon-switch</div>
  <div><i class="icon-power-cord"></i> icon-power-cord</div>
  <div><i class="icon-clipboard"></i> icon-clipboard</div>
  <div><i class="icon-list-numbered"></i> icon-list-numbered</div>
  <div><i class="icon-list"></i> icon-list</div>
  <div><i class="icon-list2"></i> icon-list2</div>
  <div><i class="icon-tree"></i> icon-tree</div>
  <div><i class="icon-menu"></i> icon-menu</div>
  <div><i class="icon-menu2"></i> icon-menu2</div>
  <div><i class="icon-cloud"></i> icon-cloud</div>
  <div><i class="icon-cloud-download"></i> icon-cloud-download</div>
  <div><i class="icon-cloud-upload"></i> icon-cloud-upload</div>
  <div><i class="icon-cloud-check"></i> icon-cloud-check</div>
  <div><i class="icon-download2"></i> icon-download2</div>
  <div><i class="icon-upload2"></i> icon-upload2</div>
  <div><i class="icon-download3"></i> icon-download3</div>
  <div><i class="icon-upload3"></i> icon-upload3</div>
  <div><i class="icon-sphere"></i> icon-sphere</div>
  <div><i class="icon-link"></i> icon-link</div>
  <div><i class="icon-flag"></i> icon-flag</div>
  <div><i class="icon-attachment"></i> icon-attachment</div>
  <div><i class="icon-eye"></i> icon-eye</div>
  <div><i class="icon-eye-plus"></i> icon-eye-plus</div>
  <div><i class="icon-eye-minus"></i> icon-eye-minus</div>
  <div><i class="icon-eye-blocked"></i> icon-eye-blocked</div>
  <div><i class="icon-bookmark"></i> icon-bookmark</div>
  <div><i class="icon-star-empty"></i> icon-star-empty</div>
  <div><i class="icon-star-full"></i> icon-star-full</div>
  <div><i class="icon-heart"></i> icon-heart</div>
  <div><i class="icon-heart-broken"></i> icon-heart-broken</div>
  <div><i class="icon-smile2"></i> icon-smile2</div>
  <div><i class="icon-sad2"></i> icon-sad2</div>
  <div><i class="icon-warning"></i> icon-warning</div>
  <div><i class="icon-notification"></i> icon-notification</div>
  <div><i class="icon-question"></i> icon-question</div>
  <div><i class="icon-info"></i> icon-info</div>
  <div><i class="icon-cancel-circle"></i> icon-cancel-circle</div>
  <div><i class="icon-blocked"></i> icon-blocked</div>
  <div><i class="icon-cross"></i> icon-cross</div>
  <div><i class="icon-checkmark"></i> icon-checkmark</div>
  <div><i class="icon-enter"></i> icon-enter</div>
  <div><i class="icon-exit"></i> icon-exit</div>
  <div><i class="icon-play3"></i> icon-play3</div>
  <div><i class="icon-pause2"></i> icon-pause2</div>
  <div><i class="icon-stop2"></i> icon-stop2</div>
  <div><i class="icon-backward2"></i> icon-backward2</div>
  <div><i class="icon-forward3"></i> icon-forward3</div>
  <div><i class="icon-first"></i> icon-first</div>
  <div><i class="icon-last"></i> icon-last</div>
  <div><i class="icon-previous2"></i> icon-previous2</div>
  <div><i class="icon-next2"></i> icon-next2</div>
  <div><i class="icon-eject"></i> icon-eject</div>
  <div><i class="icon-volume-high"></i> icon-volume-high</div>
  <div><i class="icon-volume-medium"></i> icon-volume-medium</div>
  <div><i class="icon-volume-low"></i> icon-volume-low</div>
  <div><i class="icon-volume-mute"></i> icon-volume-mute</div>
  <div><i class="icon-volume-mute2"></i> icon-volume-mute2</div>
  <div><i class="icon-volume-increase"></i> icon-volume-increase</div>
  <div><i class="icon-volume-decrease"></i> icon-volume-decrease</div>
  <div><i class="icon-loop"></i> icon-loop</div>
  <div><i class="icon-loop2"></i> icon-loop2</div>
  <div><i class="icon-arrow-up"></i> icon-arrow-up</div>
  <div><i class="icon-arrow-right"></i> icon-arrow-right</div>
  <div><i class="icon-arrow-down"></i> icon-arrow-down</div>
  <div><i class="icon-arrow-left"></i> icon-arrow-left</div>
  <div><i class="icon-move-up"></i> icon-move-up</div>
  <div><i class="icon-move-down"></i> icon-move-down</div>
  <div><i class="icon-sort-alpha-asc"></i> icon-sort-alpha-asc</div>
  <div><i class="icon-sort-alpha-desc"></i> icon-sort-alpha-desc</div>
  <div><i class="icon-sort-numeric-asc"></i> icon-sort-numeric-asc</div>
  <div><i class="icon-sort-numberic-desc"></i> icon-sort-numberic-desc</div>
  <div><i class="icon-sort-amount-asc"></i> icon-sort-amount-asc</div>
  <div><i class="icon-sort-amount-desc"></i> icon-sort-amount-desc</div>
  <div><i class="icon-checkbox-checked"></i> icon-checkbox-checked</div>
  <div><i class="icon-checkbox-unchecked"></i> icon-checkbox-unchecked</div>
  <div><i class="icon-radio-checked"></i> icon-radio-checked</div>
  <div><i class="icon-radio-checked2"></i> icon-radio-checked2</div>
  <div><i class="icon-make-group"></i> icon-make-group</div>
  <div><i class="icon-scissors"></i> icon-scissors</div>
  <div><i class="icon-filter"></i> icon-filter</div>
  <div><i class="icon-table2"></i> icon-table2</div>
  <div><i class="icon-insert-template"></i> icon-insert-template</div>
  <div><i class="icon-embed"></i> icon-embed</div>
  <div><i class="icon-embed2"></i> icon-embed2</div>
  <div><i class="icon-terminal"></i> icon-terminal</div>
  <div><i class="icon-share2"></i> icon-share2</div>
  <div><i class="icon-google"></i> icon-google</div>
  <div><i class="icon-facebook"></i> icon-facebook</div>
  <div><i class="icon-youtube"></i> icon-youtube</div>
  <div><i class="icon-github"></i> icon-github</div>
  <div><i class="icon-pinterest"></i> icon-pinterest</div>
  <div><i class="icon-paypal"></i> icon-paypal</div>
  <div><i class="icon-file-pdf"></i> icon-file-pdf</div>
  <div><i class="icon-file-word"></i> icon-file-word</div>
  <div><i class="icon-file-excel"></i> icon-file-excel</div>
  <div><i class="icon-libreoffice"></i> icon-libreoffice</div>
  <div><i class="icon-html-five"></i> icon-html-five</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>