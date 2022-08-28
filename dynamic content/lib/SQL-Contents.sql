CREATE TABLE `contents` (
  `content_id` bigint(20) NOT NULL,
  `content_title` varchar(255) NOT NULL,
  `content_text` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `contents` (`content_id`, `content_title`, `content_text`) VALUES
(1, 'It Works!', 'This piece of content is loaded from the <strong>database</strong>.');

ALTER TABLE `contents`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `content_title` (`content_title`),
  ADD KEY `content_text` (`content_text`(1024)),
  ADD KEY `date_created` (`date_created`),
  ADD KEY `date_modified` (`date_modified`);

ALTER TABLE `contents`
  MODIFY `content_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
