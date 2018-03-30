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

//CREATE TABLE IF NOT EXISTS `camagru`.`likes` (
//`user`  INT(10) UNSIGNED NOT NULL,
//	`photo` INT(10) UNSIGNED NOT NULL
//);



