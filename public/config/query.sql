DROP TABLE IF EXISTS `camagru`.`likes`;
DROP TABLE IF EXISTS `camagru`.`comments`;
DROP TABLE IF EXISTS `camagru`.`photos`;
DROP TABLE IF EXISTS `camagru`.`users`;

DROP DATABASE IF EXISTS `camagru`;


CREATE DATABASE IF NOT EXISTS `camagru`;

CREATE TABLE IF NOT EXISTS `camagru`.`users` (
    `user_id`     INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_name`       VARCHAR(20)      NOT NULL,
	`email`       VARCHAR(255)     NOT NULL,
	`password`    VARCHAR(255)     NOT NULL,
	`activated`      TINYINT(1)       NOT NULL DEFAULT '0',
	`hash` VARCHAR(255)             DEFAULT NULL,
	`notifications`      TINYINT(1)       NOT NULL DEFAULT '1',


	PRIMARY KEY (`user_id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `camagru`.`photos` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name`     VARCHAR(255)     NOT NULL,
	`likes`    INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`user_id`  INT(10) UNSIGNED NOT NULL,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`user_id`) REFERENCES `camagru`.`users` (`user_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `camagru`.`comments` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`body`       VARCHAR(300)     NOT NULL,
	`user_name`       VARCHAR(16)      NOT NULL,
	`user_id`   INT(10) UNSIGNED NOT NULL,
	`photo_id`   INT(10) UNSIGNED NOT NULL,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`user_id`) REFERENCES `camagru`.`users` (`user_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,


	FOREIGN KEY (`photo_id`) REFERENCES `camagru`.`photos` (`id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `camagru`.`likes` (
    `user_id`  INT(10) UNSIGNED NOT NULL,
	`photo_id` INT(10) UNSIGNED NOT NULL,

	PRIMARY KEY (`user_id`, `photo_id`),
	FOREIGN KEY (`user_id`) REFERENCES `camagru`.`users` (`user_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (`photo_id`) REFERENCES `camagru`.`photos` (`id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
)
ENGINE = InnoDB;