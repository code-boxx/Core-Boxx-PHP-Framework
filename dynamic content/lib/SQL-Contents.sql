CREATE TABLE `contents` (
  `content_id` bigint(20) NOT NULL,
  `content_slug` varchar(255) NOT NULL,
  `content_title` varchar(255) NOT NULL,
  `content_text` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `contents` (`content_id`, `content_slug`, `content_title`, `content_text`, `date_created`, `date_modified`) VALUES
(1, 'hello', 'It Works!', 'This piece of content is loaded from the <strong>database</strong>.', '2023-07-20 14:38:05', '2023-07-20 14:38:05');

ALTER TABLE `contents`
  ADD PRIMARY KEY (`content_id`),
  ADD UNIQUE KEY `content_slug` (`content_slug`),
  ADD KEY `content_title` (`content_title`),
  ADD KEY `content_text` (`content_text`(768)),
  ADD KEY `date_created` (`date_created`),
  ADD KEY `date_modified` (`date_modified`);

ALTER TABLE `contents`
  MODIFY `content_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;