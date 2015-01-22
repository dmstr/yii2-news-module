-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema p4_magplan
-- -----------------------------------------------------
-- MagPlan Webseite 2015

-- -----------------------------------------------------
-- Table `dmstr_news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dmstr_news` ;

CREATE TABLE IF NOT EXISTS `dmstr_news` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `text_html` TEXT NOT NULL,
  `location` VARCHAR(255) NULL,
  `published_at` DATETIME NOT NULL,
  `image` VARCHAR(255) NOT NULL COMMENT 'from moxiemanager\n',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dmstr_image_gallery`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dmstr_image_gallery` ;

CREATE TABLE IF NOT EXISTS `dmstr_image_gallery` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `news_id` INT NULL,
  `name` VARCHAR(100) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_gallery_photo_news1`
    FOREIGN KEY (`news_id`)
    REFERENCES `dmstr_news` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dmstr_video_gallery`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dmstr_video_gallery` ;

CREATE TABLE IF NOT EXISTS `dmstr_video_gallery` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `news_id` INT NULL,
  `name` VARCHAR(100) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_video_news1`
    FOREIGN KEY (`news_id`)
    REFERENCES `dmstr_news` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dmstr_text_block`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dmstr_text_block` ;

CREATE TABLE IF NOT EXISTS `dmstr_text_block` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `news_id` INT NULL,
  `title` VARCHAR(100) NULL,
  `text_html` TEXT NOT NULL,
  `source` VARCHAR(255) NULL,
  `image` VARCHAR(255) NULL,
  `published_at` DATETIME NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_text_block_news1`
    FOREIGN KEY (`news_id`)
    REFERENCES `dmstr_news` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dmstr_image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dmstr_image` ;

CREATE TABLE IF NOT EXISTS `dmstr_image` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `photo_gallery_id` INT NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `text_html` TEXT NOT NULL,
  `published_at` DATETIME NOT NULL,
  `source` VARCHAR(255) NOT NULL,
  `tags` VARCHAR(45) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_khf_image_khf_photo_gallery1`
    FOREIGN KEY (`photo_gallery_id`)
    REFERENCES `dmstr_image_gallery` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dmstr_video`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dmstr_video` ;

CREATE TABLE IF NOT EXISTS `dmstr_video` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `video_gallery_id` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `youtube_url` VARCHAR(255) NOT NULL,
  `published_at` DATETIME NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_khf_video_khf_video_gallery1`
    FOREIGN KEY (`video_gallery_id`)
    REFERENCES `dmstr_video_gallery` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
