<?php
// (A) GET CONTENTS
$contents = $_CORE->autoCall("Contents", "getAll");

// (B) DRAW CONTENTS LIST
if (is_array($contents)) { foreach ($contents as $id=>$content) { ?>
<div class="d-flex align-items-center border p-2">
  <div class="flex-grow-1">
    <div class="fw-bold"><?=$content["content_title"]?></div>
    <div><a target="_blank" href="<?=HOST_BASE?>post/<?=$content["content_slug"]?>">
      <?=HOST_BASE?>post/<?=$content["content_slug"]?>
    </a></div>
    <div class="small text-secondary">
      Last Modified: <?=$content["date_modified"]?>
    </div>
  </div>
  <div class="dropdown">
    <button class="btn btn-primary p-3 ico-sm icon-arrow-right" type="button" data-bs-toggle="dropdown"></button>
    <ul class="dropdown-menu dropdown-menu-dark">
      <li class="dropdown-item" onclick="content.addEdit(<?=$id?>)">
        <i class="text-secondary ico-sm icon-pencil"></i> Edit
      </li>
      <li><a class="dropdown-item" target="_blank" href="<?=HOST_BASE?>post/<?=$content["content_slug"]?>">
        <i class="text-secondary ico-sm icon-zoom-in"></i> View
      </a></li>
      <li class="dropdown-item text-warning" onclick="content.del(<?=$id?>)">
        <i class="ico-sm icon-bin2"></i> Delete
      </li>
    </ul>
  </div>
</div>
<?php }} else { echo "No contents found."; }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw("content.goToPage");