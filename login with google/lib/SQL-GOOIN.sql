ALTER TABLE `users` ADD `google_id` VARCHAR(32) NULL DEFAULT NULL AFTER `user_password`, ADD UNIQUE (`google_id`);