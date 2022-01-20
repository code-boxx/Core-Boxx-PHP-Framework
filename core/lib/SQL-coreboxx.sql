CREATE TABLE `options` (
  `option_name` varchar(255) NOT NULL,
  `option_description` varchar(255) DEFAULT NULL,
  `option_value` varchar(255) NOT NULL,
  `option_group` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `options` (`option_name`, `option_description`, `option_value`, `option_group`) VALUES
('EMAIL_FROM', 'System email from.', 'sys@site.com', 1),
('PAGE_PER', 'Number of entries per page.', '20', 1);

ALTER TABLE `options`
  ADD PRIMARY KEY (`option_name`),
  ADD KEY `option_group` (`option_group`);
