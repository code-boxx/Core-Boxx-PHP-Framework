-- (A) MAIN MENU TABLE
CREATE TABLE `menu` (
  `menu_id` bigint(20) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

ALTER TABLE `menu`
  MODIFY `menu_id` bigint(20) NOT NULL AUTO_INCREMENT;

-- (B) MENU ITEMS
CREATE TABLE `menu_items` (
  `menu_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `item_label` varchar(255) NOT NULL,
  `item_link` varchar(255) NOT NULL,
  `item_target` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`menu_id`,`item_id`),
  ADD KEY `parent_id` (`parent_id`);
