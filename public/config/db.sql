DROP TABLE IF EXISTS `camagru`.`liked`;
DROP TABLE IF EXISTS `camagru`.`notifications`;
DROP TABLE IF EXISTS `camagru`.`comments`;
DROP TABLE IF EXISTS `camagru`.`photos`;
DROP TABLE IF EXISTS `camagru`.`users`;
DROP DATABASE IF EXISTS `camagru`;

CREATE DATABASE IF NOT EXISTS `camagru`;

CREATE TABLE IF NOT EXISTS `camagru`.`users` (
	`user_id`     INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`login`       VARCHAR(16)      NOT NULL,
	`email`       VARCHAR(255)     NOT NULL,
	`password`    VARCHAR(255)     NOT NULL,
	`firstname`   VARCHAR(32)      NOT NULL DEFAULT 'Firstname',
	`lastname`    VARCHAR(32)      NOT NULL DEFAULT 'Lastname',
	`avatar`      VARCHAR(255)     NOT NULL DEFAULT 'templates/user_ava.jpg',
	`active_hash` VARCHAR(255)              DEFAULT NULL,
	`active_time` TIMESTAMP        NULL     DEFAULT NULL,
	`status`      TINYINT(1)       NOT NULL DEFAULT '0',

	PRIMARY KEY (`user_id`)
);

CREATE TABLE IF NOT EXISTS `camagru`.`photos` (
	`photo_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`path`     VARCHAR(255)     NOT NULL,
	`likes`    INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`user_id`  INT(11) UNSIGNED NOT NULL,

	PRIMARY KEY (`photo_id`),
	FOREIGN KEY (`user_id`) REFERENCES `camagru`.`users` (`user_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `camagru`.`comments` (
	`comment_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`text`       VARCHAR(255)     NOT NULL,
	`time`       TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`user_id`    INT(10) UNSIGNED NOT NULL,
	`photo_id`   INT(10) UNSIGNED NOT NULL,

	PRIMARY KEY (`comment_id`),
	FOREIGN KEY (`user_id`) REFERENCES `camagru`.`users` (`user_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (`photo_id`) REFERENCES `camagru`.`photos` (`photo_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `camagru`.`notifications` (
	`notifications_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user`             INT(10) UNSIGNED NOT NULL,
	`text`             VARCHAR(22)      NOT NULL,
	`photo`            INT(10) UNSIGNED NOT NULL,
	`status`           TINYINT(1)       NOT NULL DEFAULT '0',

	PRIMARY KEY (`notifications_id`),
	FOREIGN KEY (`user`) REFERENCES `camagru`.`users` (`user_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (`photo`) REFERENCES `camagru`.`photos` (`photo_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `camagru`.`liked` (
	`user`  INT(10) UNSIGNED NOT NULL,
	`photo` INT(10) UNSIGNED NOT NULL,

	PRIMARY KEY (`user`, `photo`),
	FOREIGN KEY (`user`) REFERENCES `camagru`.`users` (`user_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (`photo`) REFERENCES `camagru`.`photos` (`photo_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);