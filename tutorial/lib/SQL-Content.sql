CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;