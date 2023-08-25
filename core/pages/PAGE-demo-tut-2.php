<h5 class="text-danger mb-2">CREATE DATABASE TABLE</h5>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-2"><code>CREATE TABLE `items` (
  `item_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;</code></pre>

<div class="bg-white border p-4 mb-4">
  For this example, we will create a list of items.
</div>

<div class="mb-4">
  <button type="button" class="my-1 btn btn-danger d-flex-inline" onclick="tut(1)"> 
    <i class="ico-sm icon-arrow-left"></i> Last Page
  </button>
  <button type="button" class="my-1 btn btn-primary d-flex-inline" onclick="tut(3)"> 
    Next Page <i class="ico-sm icon-arrow-right"></i>
  </button>
</div>