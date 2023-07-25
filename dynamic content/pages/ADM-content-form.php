<?php
// (A) GET CONTENT
$edit = isset($_POST["id"]) && $_POST["id"]!="";
if ($edit) { $content = $_CORE->autoCall("Contents", "get"); }

// (B) CONTENT FORM ?>
<h3 class="mb-3"><?=$edit?"EDIT":"ADD"?> CONTENT</h3>
<form onsubmit="return content.save()">
  <div class="bg-white border p-4 my-3">
    <input type="hidden" id="content_id" value="<?=isset($content)?$content["content_id"]:""?>">

    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="content_slug" required value="<?=isset($content)?$content["content_slug"]:""?>">
      <label>Slug</label>
    </div>

    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="content_title" required value="<?=isset($content)?$content["content_title"]:""?>">
      <label>Title</label>
    </div>

    <textarea id="content_text" class="form-control"><?=isset($content)?$content["content_text"]:""?></textarea>
  </div>

  <input type="button" class="col btn btn-danger" value="Back" onclick="cb.page(1)">
  <input type="submit" class="col btn btn-primary" value="Save">
</form>