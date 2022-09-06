CREATE TABLE `webpush` (
  `endpoint` varchar(255) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `webpush`
  ADD PRIMARY KEY (`endpoint`);