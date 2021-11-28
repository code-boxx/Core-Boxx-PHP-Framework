CREATE TABLE `contents` (
  `content_id` bigint(20) NOT NULL,
  `content_title` varchar(255) NOT NULL,
  `content_text` text NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `contents`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `content_title` (`content_title`),
  ADD KEY `content_text` (`content_text`(3072)),
  ADD KEY `date_created` (`date_created`),
  ADD KEY `date_modified` (`date_modified`);

ALTER TABLE `contents`
  MODIFY `content_id` bigint(20) NOT NULL AUTO_INCREMENT;
