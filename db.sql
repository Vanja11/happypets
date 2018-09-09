-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema udomljavanje
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema udomljavanje
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `udomljavanje` DEFAULT CHARACTER SET utf8 ;
USE `udomljavanje` ;

-- -----------------------------------------------------
-- Table `udomljavanje`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `udomljavanje`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(254) NOT NULL,
  `password` VARCHAR(40) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `phone` VARCHAR(10) NOT NULL,
  `type` ENUM('user', 'admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `udomljavanje`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `udomljavanje`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `parent_id` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_categories_categories1_idx` (`parent_id` ASC),
  CONSTRAINT `fk_categories_categories1`
    FOREIGN KEY (`parent_id`)
    REFERENCES `udomljavanje`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `udomljavanje`.`ads`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `udomljavanje`.`ads` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(32) NOT NULL,
  `description` TEXT(1000) NOT NULL,
  `users_id` INT NOT NULL,
  `phone` VARCHAR(10) NULL,
  `categories_id` INT NOT NULL,
  `viewed_count` INT NOT NULL DEFAULT 0,
  `adopted` TINYINT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT NOW(),
  `updated_at` DATETIME NOT NULL DEFAULT NOW(),
  `deleted_at` DATETIME NULL,
  `expires_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_ads_users1_idx` (`users_id` ASC),
  INDEX `fk_ads_categories1_idx` (`categories_id` ASC),
  CONSTRAINT `fk_ads_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `udomljavanje`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ads_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `udomljavanje`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `udomljavanje`.`uploads`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `udomljavanje`.`uploads` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `path` VARCHAR(255) NOT NULL,
  `ads_id` INT NOT NULL,
  PRIMARY KEY (`id`, `ads_id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_uploads_ads1_idx` (`ads_id` ASC),
  CONSTRAINT `fk_uploads_ads1`
    FOREIGN KEY (`ads_id`)
    REFERENCES `udomljavanje`.`ads` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `udomljavanje`.`requests`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `udomljavanje`.`requests` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `answers` TEXT(1000) NOT NULL,
  `ads_id` INT NOT NULL,
  `users_id` INT NULL,
  `created_at` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`, `ads_id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_requests_ads1_idx` (`ads_id` ASC),
  INDEX `fk_requests_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_requests_ads1`
    FOREIGN KEY (`ads_id`)
    REFERENCES `udomljavanje`.`ads` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requests_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `udomljavanje`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
