CREATE TABLE `reactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reaction` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `reaction` (`reaction`);
