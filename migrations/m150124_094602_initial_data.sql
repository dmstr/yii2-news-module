-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema p4_khf
-- -----------------------------------------------------
-- Kohlhammer Feuerwehr Webseite 2015

-- -----------------------------------------------------
-- Table `khf_magazine`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_magazine` ;

CREATE TABLE IF NOT EXISTS `khf_magazine` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `text_html` TEXT NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `edition_year` VARCHAR(255) NOT NULL COMMENT 'Datepicker with month and years\n',
  `edition_number` VARCHAR(45) NULL,
  `link_title` VARCHAR(45) NULL,
  `link_url` VARCHAR(255) NULL,
  `link_target` VARCHAR(45) NULL,
  `link_pdf` VARCHAR(255) NULL COMMENT 'Abo only',
  `published_at` DATETIME NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_author`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_author` ;

CREATE TABLE IF NOT EXISTS `khf_author` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `text_html` TEXT NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_article`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_article` ;

CREATE TABLE IF NOT EXISTS `khf_article` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `author_id` INT NULL,
  `magazin_id` INT NULL,
  `title` VARCHAR(255) NOT NULL,
  `text_html` TEXT NULL,
  `link_title` VARCHAR(45) NULL,
  `link_url` VARCHAR(255) NULL,
  `link_target` VARCHAR(45) NULL,
  `published_at` DATETIME NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_article_magazin1`
    FOREIGN KEY (`magazin_id`)
    REFERENCES `khf_magazine` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_article_author1`
    FOREIGN KEY (`author_id`)
    REFERENCES `khf_author` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_news` ;

CREATE TABLE IF NOT EXISTS `khf_news` (
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
-- Table `khf_image_gallery`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_image_gallery` ;

CREATE TABLE IF NOT EXISTS `khf_image_gallery` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `news_id` INT NULL,
  `name` VARCHAR(100) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_gallery_photo_news1`
    FOREIGN KEY (`news_id`)
    REFERENCES `khf_news` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_schedule`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_schedule` ;

CREATE TABLE IF NOT EXISTS `khf_schedule` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `subtitle` VARCHAR(255) NULL,
  `organizer` VARCHAR(255) NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `text_html` TEXT NULL,
  `link_title` VARCHAR(45) NULL,
  `link_url` VARCHAR(255) NULL,
  `link_target` VARCHAR(45) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_video_gallery`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_video_gallery` ;

CREATE TABLE IF NOT EXISTS `khf_video_gallery` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `news_id` INT NULL,
  `name` VARCHAR(100) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_video_news1`
    FOREIGN KEY (`news_id`)
    REFERENCES `khf_news` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_teaser_header`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_teaser_header` ;

CREATE TABLE IF NOT EXISTS `khf_teaser_header` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(45) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `subtitle` VARCHAR(45) NOT NULL,
  `link_title` VARCHAR(45) NULL,
  `link_url` VARCHAR(255) NULL,
  `link_target` VARCHAR(45) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `category_UNIQUE` (`category` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_text_block`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_text_block` ;

CREATE TABLE IF NOT EXISTS `khf_text_block` (
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
    REFERENCES `khf_news` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_service_plus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_service_plus` ;

CREATE TABLE IF NOT EXISTS `khf_service_plus` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(60) NOT NULL COMMENT 'Under Service, free configurable pages\n',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_special`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_special` ;

CREATE TABLE IF NOT EXISTS `khf_special` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(60) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_commercial_banner`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_commercial_banner` ;

CREATE TABLE IF NOT EXISTS `khf_commercial_banner` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `magazin_id` INT NULL,
  `news_id` INT NULL,
  `service_plus_id` INT NULL,
  `special_id` INT NULL,
  `image_title` VARCHAR(255) NOT NULL,
  `link_title` VARCHAR(45) NOT NULL,
  `link_url` VARCHAR(255) NOT NULL,
  `link_target` VARCHAR(45) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `published_at` DATETIME NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_commercial_banner_magazin1`
    FOREIGN KEY (`magazin_id`)
    REFERENCES `khf_magazine` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commercial_banner_news1`
    FOREIGN KEY (`news_id`)
    REFERENCES `khf_news` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commercial_banner_service_plus1`
    FOREIGN KEY (`service_plus_id`)
    REFERENCES `khf_service_plus` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_khf_commercial_banner_khf_special1`
    FOREIGN KEY (`special_id`)
    REFERENCES `khf_special` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_product` ;

CREATE TABLE IF NOT EXISTS `khf_product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `image` VARCHAR(255) NULL COMMENT 'from moxiemanager',
  `text_html` TEXT NOT NULL,
  `link_title` VARCHAR(45) NOT NULL,
  `link_url` VARCHAR(255) NOT NULL,
  `link_target` VARCHAR(45) NOT NULL,
  `published_at` DATETIME NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_member_area`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_member_area` ;

CREATE TABLE IF NOT EXISTS `khf_member_area` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `text_html` TEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_abonnement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_abonnement` ;

CREATE TABLE IF NOT EXISTS `khf_abonnement` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `read_type` VARCHAR(10) NOT NULL DEFAULT 'sub',
  `keyID` VARCHAR(255) NOT NULL COMMENT 'username',
  `keyword` VARCHAR(60) NOT NULL COMMENT 'password',
  `productID` VARCHAR(45) NOT NULL DEFAULT 'BS23',
  `installations` INT(5) NOT NULL DEFAULT '10',
  `start` DATE NOT NULL,
  `end` DATE NULL,
  `trial` VARCHAR(45) NULL DEFAULT 0,
  `last_start_trial` DATE NULL,
  `firstname` VARCHAR(80) NOT NULL,
  `lastname` VARCHAR(80) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NULL,
  `abo_number` VARCHAR(45) NULL,
  `abo_number_check` TINYINT NULL COMMENT 'i have no abo number',
  `abo_by` VARCHAR(45) NULL COMMENT 'i.e. Wittwer\n',
  `newsletter` TINYINT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `keyID_UNIQUE` (`keyID` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_abo_number`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_abo_number` ;

CREATE TABLE IF NOT EXISTS `khf_abo_number` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `abo_number` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_image` ;

CREATE TABLE IF NOT EXISTS `khf_image` (
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
    REFERENCES `khf_image_gallery` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_video`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_video` ;

CREATE TABLE IF NOT EXISTS `khf_video` (
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
    REFERENCES `khf_video_gallery` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_tag` ;

CREATE TABLE IF NOT EXISTS `khf_tag` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tag` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `tag_UNIQUE` (`tag` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `khf_article_x_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `khf_article_x_tag` ;

CREATE TABLE IF NOT EXISTS `khf_article_x_tag` (
  `article_id` INT NOT NULL,
  `tag_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`article_id`, `tag_id`),
  CONSTRAINT `fk_khf_article_has_khf_tag_khf_article1`
    FOREIGN KEY (`article_id`)
    REFERENCES `khf_article` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_khf_article_has_khf_tag_khf_tag1`
    FOREIGN KEY (`tag_id`)
    REFERENCES `khf_tag` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `migration`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `migration` ;

CREATE TABLE IF NOT EXISTS `migration` (
  `version` VARCHAR(180) NOT NULL,
  `alias` VARCHAR(180) NOT NULL,
  `apply_time` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`version`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `moxman_cache`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `moxman_cache` ;

CREATE TABLE IF NOT EXISTS `moxman_cache` (
  `mc_id` INT(10) NOT NULL AUTO_INCREMENT,
  `mc_path` VARCHAR(745) NOT NULL,
  `mc_name` VARCHAR(255) NOT NULL,
  `mc_extension` VARCHAR(255) NOT NULL,
  `mc_attrs` CHAR(4) NOT NULL,
  `mc_size` INT(11) NULL DEFAULT NULL,
  `mc_last_modified` DATETIME NOT NULL,
  `mc_cached_time` DATETIME NOT NULL,
  PRIMARY KEY (`mc_id`),
  INDEX `mc_path_mc_name` (`mc_path`(247) ASC, `mc_name`(85) ASC),
  INDEX `mc_path_mc_size` (`mc_path`(247) ASC, `mc_size` ASC),
  INDEX `mc_path` (`mc_path`(255) ASC),
  INDEX `mc_name` (`mc_name`(85) ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 66
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `moxman_hashmap`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `moxman_hashmap` ;

CREATE TABLE IF NOT EXISTS `moxman_hashmap` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mc_id` INT(11) NOT NULL,
  `mc_last_modified` DATETIME NOT NULL,
  `hash` VARCHAR(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  CONSTRAINT `moxman_hashmap_ibfk_1`
    FOREIGN KEY (`mc_id`)
    REFERENCES `moxman_cache` (`mc_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `moxman_property`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `moxman_property` ;

CREATE TABLE IF NOT EXISTS `moxman_property` (
  `pr_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pr_name` VARCHAR(128) NULL DEFAULT NULL,
  `pr_user` VARCHAR(128) NULL DEFAULT NULL,
  `pr_group` VARCHAR(128) NULL DEFAULT NULL,
  `pr_value` TEXT NULL DEFAULT NULL,
  `pr_creationdate` DATETIME NULL DEFAULT NULL,
  `pr_modificationdate` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`pr_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user` ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(25) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(60) NOT NULL,
  `auth_key` VARCHAR(32) NOT NULL,
  `confirmed_at` INT(11) NULL DEFAULT NULL,
  `unconfirmed_email` VARCHAR(255) NULL DEFAULT NULL,
  `blocked_at` INT(11) NULL DEFAULT NULL,
  `role` VARCHAR(255) NULL DEFAULT NULL,
  `registration_ip` BIGINT(20) NULL DEFAULT NULL,
  `created_at` INT(11) NOT NULL,
  `updated_at` INT(11) NOT NULL,
  `flags` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_unique_username` (`username` ASC),
  UNIQUE INDEX `user_unique_email` (`email` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `profile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `profile` ;

CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` INT(11) NOT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `public_email` VARCHAR(255) NULL DEFAULT NULL,
  `gravatar_email` VARCHAR(255) NULL DEFAULT NULL,
  `gravatar_id` VARCHAR(32) NULL DEFAULT NULL,
  `location` VARCHAR(255) NULL DEFAULT NULL,
  `website` VARCHAR(255) NULL DEFAULT NULL,
  `bio` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `social_account`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `social_account` ;

CREATE TABLE IF NOT EXISTS `social_account` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NULL DEFAULT NULL,
  `provider` VARCHAR(255) NOT NULL,
  `client_id` VARCHAR(255) NOT NULL,
  `data` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `account_unique` (`provider` ASC, `client_id` ASC),
  CONSTRAINT `fk_user_account`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `token`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `token` ;

CREATE TABLE IF NOT EXISTS `token` (
  `user_id` INT(11) NOT NULL,
  `code` VARCHAR(32) NOT NULL,
  `created_at` INT(11) NOT NULL,
  `type` SMALLINT(6) NOT NULL,
  CONSTRAINT `fk_user_token`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
