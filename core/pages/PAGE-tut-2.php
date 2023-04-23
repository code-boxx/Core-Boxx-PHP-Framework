<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="display-6 mb-4">VERY FAST TUTORIAL 2/6</div>

<div class="mb-1 fw-bold">
  Create database tables as required.
  For this example, we will create a list of items.
</div>
<pre class="mb-4 p-3 bg-dark text-white border"><code>CREATE TABLE `items` (
  `item_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;</code></pre>

<div class="mb-4">
  <a class="btn btn-danger" href="<?=HOST_BASE?>tut/1">Last Page</a>
  <a class="btn btn-primary" href="<?=HOST_BASE?>tut/3">Next Page</a>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>