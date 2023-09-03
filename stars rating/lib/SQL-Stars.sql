CREATE TABLE `star_rating` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `rating` smallint(6) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `star_rating`
  ADD PRIMARY KEY (`id`,`user_id`);

INSERT INTO `star_rating` (`id`, `user_id`, `rating`) VALUES
(999, 900, 1),
(999, 901, 2),
(999, 902, 3),
(999, 903, 4),
(999, 904, 5),
(999, 905, 3);