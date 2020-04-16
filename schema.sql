CREATE DATABASE doingsdone_db DEFAULT CHARACTER SET utf8;

CREATE TABLE `doingsdone_db`.`project` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `user_id` INT(11) NOT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `doingsdone_db`.`task` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `pubdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `status` INT(11) NOT NULL DEFAULT '0' ,
  `title` VARCHAR(255) NOT NULL ,
  `link` TEXT NULL ,
  `deadline` DATE NULL ,
  `user_id` INT(11) NOT NULL ,
  `project_id` INT(11) NOT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `doingsdone_db`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `reg_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `email` VARCHAR(100) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;
