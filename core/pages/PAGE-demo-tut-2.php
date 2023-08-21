<h5 class="text-danger">CREATE DATABASE TABLE</h5>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-2"><code>CREATE TABLE `items` (
  `item_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;</code></pre>

<div class="bg-white border p-4 mb-4">
  For this example, we will create a list of items.
</div>

<div class="mb-4 d-flex">
  <button class="btn btn-danger w-50 mx-1 d-flex align-items-center justify-content-center" onclick="tut(1)">
    <i class="ico-sm icon-arrow-left me-2"></i> Last Page
  </button>
  <button class="btn btn-primary w-50 mx-1 d-flex align-items-center justify-content-center" onclick="tut(3)">
    Next Page <i class="ico-sm icon-arrow-right ms-2"></i>
  </button>
</div>