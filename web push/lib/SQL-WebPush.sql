CREATE TABLE `webpush` (
  `endpoint` varchar(255) NOT NULL,
  `user_id` bigint(20) NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `webpush`
  ADD PRIMARY KEY (`endpoint`),
  ADD KEY `user_id` (`user_id`);