CREATE TABLE `cb_version` (
  `name` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `cb_version`
  ADD PRIMARY KEY (`name`);
