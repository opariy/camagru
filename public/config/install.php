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
