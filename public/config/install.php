<?php
/**
 * Created by PhpStorm.
 * User: opariy
 * Date: 25.02.2018
 * Time: 14:10
 */

echo "here you connect to DB<br>";
echo "SUCCESS! <a href='/'>GO TO CAMAGRU</a>";


//
//CREATE TABLE `camagru`.`users` UNIQUE KEY ( `user_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT , `user_name` VARCHAR(20) NOT NULL , `email` VARCHAR(255) NOT NULL ,  `hash` VARCHAR(32) NOT NULL ,`password` VARCHAR(255) DEFAULT NULL ,`activated` INT DEFAULT NULL ,  PRIMARY KEY (`user_id`)) ENGINE = InnoDB;


//CREATE TABLE `camagru`.`photos` ( `id` INT NOT NULL AUTO_INCREMENT , `path` VARCHAR(255) NOT NULL , `likes` INT NULL DEFAULT NULL , `user_id` INT NOT NULL , PRIMARY KEY (`id`))


//INSERT INTO `comments` (`id`, `body`, `user_id`, `photo_id`) VALUES (NULL, 'nice!', '8', '1');
//INSERT INTO `comments` (`id`, `body`, `user_id`, `photo_id`) VALUES (NULL, 'nice one!', '8', '1');
//INSERT INTO `comments` (`id`, `body`, `user_id`, `photo_id`) VALUES (NULL, 'woah!', '9', '1');
//INSERT INTO `comments` (`id`, `body`, `user_id`, `photo_id`) VALUES (NULL, 'nice comment!', '8', '3');
//INSERT INTO `comments` (`id`, `body`, `user_id`, `photo_id`) VALUES (NULL, 'beautifuuul', '8', '1');
//INSERT INTO `comments` (`id`, `body`, `user_id`, `photo_id`) VALUES (NULL, 'nice one!', '9', '4');
//INSERT INTO `comments` (`id`, `body`, `user_id`, `photo_id`) VALUES (NULL, '!!!', '10', '7');
//INSERT INTO `comments` (`id`, `body`, `user_id`, `photo_id`) VALUES (NULL, 'awesome!', '9', '12');


//INSERT INTO `photos` (`user_id`, `name`) VALUES ('1', '(1)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('1', '(2)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('1', '(3)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('1', '(4)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('1', '(5)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('1', '(6)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('1', '(7)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('1', '(8)');


//INSERT INTO `photos` (`user_id`, `name`) VALUES ('2', '(1)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('2', '(2)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('2', '(3)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('2', '(4)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('2', '(5)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('2', '(6)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('2', '(7)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('2', '(8)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('2', '(9)');

//INSERT INTO `photos` (`user_id`, `name`) VALUES ('3', '(1)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('3', '(2)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('3', '(3)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('3', '(4)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('3', '(5)');
//INSERT INTO `photos` (`user_id`, `name`) VALUES ('3', '(6)');


//CREATE TABLE IF NOT EXISTS `camagru`.`likes` (
//`user`  INT(10) UNSIGNED NOT NULL,
//	`photo` INT(10) UNSIGNED NOT NULL
//);

echo '


DROP TABLE IF EXISTS `camagru`.`likes`;
DROP TABLE IF EXISTS `camagru`.`notifications`;
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
	`activated`      TINYINT(1)       NOT NULL DEFAULT \'0\', ==================================
	`hash` VARCHAR(255)             DEFAULT NULL,

	PRIMARY KEY (`user_id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `camagru`.`photos` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name`     VARCHAR(255)     NOT NULL,
	`likes`    INT(10) UNSIGNED NOT NULL DEFAULT \'0\', =======================================
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
    
    ';