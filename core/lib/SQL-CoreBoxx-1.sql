CREATE TABLE `settings` (
  `setting_name` varchar(255) NOT NULL,
  `setting_description` varchar(255) DEFAULT NULL,
  `setting_value` varchar(255) NOT NULL,
  `setting_group` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `settings` (`setting_name`, `setting_description`, `setting_value`, `setting_group`) VALUES
('APP_VER', 'App version', '1', 0),
('EMAIL_FROM', 'System email from', 'sys@site.com', 1),
('PAGE_PER', 'Number of entries per page', '20', 1),
('D_LONG', 'MYSQL date format (long)', '%e %M %Y', 1),
('D_SHORT', 'MYSQL date format (short)', '%Y-%m-%d', 1),
('DT_LONG', 'MYSQL date time format (long)', '%e %M %Y %l:%i:%S %p', 1),
('DT_SHORT', 'MYSQL date time format (short)', '%Y-%m-%d %H:%i:%S', 1);

ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_name`),
  ADD KEY `setting_group` (`setting_group`);