CREATE DATABASE IF NOT EXISTS cv_maker;
USE cv_maker;


-- USER
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(50) DEFAULT NULL,
  `email` VARCHAR(40) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `token` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------- Personals ---------------------------- 

CREATE TABLE IF NOT EXISTS `personals` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `avatar` VARCHAR(300) DEFAULT NULL,
  `first_name` VARCHAR(30) DEFAULT NULL,
  `last_name` VARCHAR(30) DEFAULT NULL,
  `cin` VARCHAR(20) DEFAULT NULL,
  `email` VARCHAR(40) DEFAULT NULL,
  `phone` VARCHAR(20) DEFAULT NULL,
  `address` VARCHAR(100) DEFAULT NULL,
  `zip` INT DEFAULT NULL,
  `city` VARCHAR(30) DEFAULT NULL,
  `job` VARCHAR(30) DEFAULT NULL,
  'bio' VARCHAR(160) DEFAULT NULL,
  `slug` VARCHAR(100) NOT NULL,
  `complet` BOOLEAN NOT NULL DEFAULT 0,
  `user_id` INT,
  FOREIGN KEY(`user_id`) REFERENCES users(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ---------------------------- Diplomes ---------------------------- 


CREATE TABLE IF NOT EXISTS `diplomes` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `diplome` VARCHAR(255) NOT NULL,
  `establishment` VARCHAR(255) NOT NULL,
  `city` VARCHAR(50) NOT NULL,
  `date_obtained` date NOT NULL,
  `description` VARCHAR(255) DEFAULT NULL,
  `person_id` INT NOT NULL,
  FOREIGN KEY (`person_id`) REFERENCES `personals`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------- Experiences ----------------------------


CREATE TABLE IF NOT EXISTS `experiences` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `experience` VARCHAR(50) NOT NULL, 
  `company` VARCHAR(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `city` VARCHAR(30) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `person_id` INT NOT NULL,
  FOREIGN KEY (`person_id`) REFERENCES `personals`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------ Hobbies --------------------------------


CREATE TABLE IF NOT EXISTS `hobbies` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `hobby` VARCHAR(50) NOT NULL,
  `person_id` INT NOT NULL,
  FOREIGN KEY (`person_id`) REFERENCES `personals`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------- Language ----------------------------------
 
CREATE TABLE IF NOT EXISTS `languages` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `language` VARCHAR(50) NOT NULL,
  `level` INT NOT NULL,
  `person_id` INT NOT NULL,
  FOREIGN KEY (`person_id`) REFERENCES `personals`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------ Qualities --------------------------------



CREATE TABLE IF NOT EXISTS `qualities` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `qualite` VARCHAR(100) NOT NULL,
  `person_id` INT NOT NULL,
  FOREIGN KEY (`person_id`) REFERENCES `personals`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -------------------------- Skills ------------------------------


CREATE TABLE IF NOT EXISTS `skills` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `skill` VARCHAR(50) NOT NULL,
  `level` INT NOT NULL,
  `person_id` INT NOT NULL,
  FOREIGN KEY (`person_id`) REFERENCES `personals`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




