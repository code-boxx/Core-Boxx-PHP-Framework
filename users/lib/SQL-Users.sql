-- (A) USERS
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `user_level` varchar(1) NOT NULL DEFAULT 'U',
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `user_level` (`user_level`);

ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;

-- (B) HASH
CREATE TABLE `users_hash` (
  `user_id` bigint(20) NOT NULL,
  `hash_for` varchar(1) NOT NULL,
  `hash_code` varchar(64) NOT NULL,
  `hash_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `users_hash`
  ADD PRIMARY KEY (`user_id`, `hash_for`);