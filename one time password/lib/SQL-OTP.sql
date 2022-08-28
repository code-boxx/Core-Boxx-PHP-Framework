CREATE TABLE `otp` (
  `user_email` varchar(255) NOT NULL,
  `otp_pass` varchar(255) NOT NULL,
  `otp_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `otp_tries` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `otp`
  ADD PRIMARY KEY (`user_email`);
