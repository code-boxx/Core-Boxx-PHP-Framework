-- (A) USERS
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_name` (`user_name`);

ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;

-- (B) JWT SETTINGS
INSERT INTO `settings` (`setting_name`, `setting_description`, `setting_value`, `setting_group`) VALUES
('JWT_SECRET', 'JSON Web Token Secret Key', 'YOUR-SECRET-KEY', 1),
('JWT_ISSUER', 'JSON Web Token Issuer', 'YOUR-NAME', 1),
('JWT_ALGO', 'JSON Web Token Algorithm', 'HS256', 1),
('JWT_EXPIRE', 'JSON Web Token Expiry', '0', 1);