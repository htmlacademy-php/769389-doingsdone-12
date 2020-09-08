CREATE DATABASE doingsdone_db
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE doingsdone_db;

CREATE TABLE `project` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` CHAR(50) NOT NULL ,
  `user_id` INT(11) NOT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `task` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `pubdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `status` INT(11) NOT NULL DEFAULT '0' ,
  `title` CHAR(50) NOT NULL ,
  `link` CHAR(100) NULL ,
  `deadline` DATE NULL ,
  `user_id` INT(11) NOT NULL ,
  `project_id` INT(11) NOT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `reg_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `email` CHAR(50) NOT NULL ,
  `name` CHAR(50) NOT NULL , UNIQUE (`email`) ,
  `password` CHAR(64) NOT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;


CREATE FULLTEXT INDEX task_search ON task(title);
