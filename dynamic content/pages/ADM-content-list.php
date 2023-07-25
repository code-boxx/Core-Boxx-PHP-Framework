<?php
// (A) GET CONTENTS
$contents = $_CORE->autoCall("Contents", "getAll");

// (B) DRAW CONTENTS LIST
if (is_array($contents)) { foreach ($contents as $id=>$content) { ?>
<div class="d-flex align-items-center border p-2">
  <div class="flex-grow-1">
    <div class="fw-bold"><?=$content["content_title"]?></div>
    <div>
      <?=HOST_BASE?>post/<?=$content["content_slug"]?>
    </div>
    <div class="small text-secondary">
      Last Modified: <?=$content["date_modified"]?>
    </div>
  </div>
  <div class="dropdown">
    <button class="btn btn-primary btn-sm mi" type="button" data-bs-toggle="dropdown">
      more_vert
    </button>
    <ul class="dropdown-menu dropdown-menu-dark">
      <li class="dropdown-item" onclick="content.addEdit(<?=$id?>)">
        <i class="mi mi-smol">edit</i> Edit
      </li>
      <li><a class="dropdown-item" target="_blank" href="<?=HOST_BASE?>post/<?=$content["content_slug"]?>">
        <i class="mi mi-smol">search</i> View
      </a></li>
      <li class="dropdown-item text-warning" onclick="content.del(<?=$id?>)">
        <i class="mi mi-smol">delete</i> Delete
      </li>
    </ul>
  </div>
</div>
<?php }} else { echo "No contents found."; }

// (C) PAGINATION
$_CORE->load("Page");
$_CORE->Page->draw("content.goToPage");