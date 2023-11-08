-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema online_shop
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `online_shop` ;

-- -----------------------------------------------------
-- Schema online_shop
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `online_shop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `online_shop` ;

-- -----------------------------------------------------
-- Table `online_shop`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`users` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `role_id` INT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone_number` VARCHAR(45) NOT NULL,
  `password` CHAR(60) NOT NULL,
  `apartment_number` VARCHAR(20) NOT NULL,
  `street` VARCHAR(100) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `region` VARCHAR(100) NOT NULL,
  `country` VARCHAR(100) NOT NULL,
  `postal_code` VARCHAR(20) NOT NULL,
  `create_date` DATE NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`role_id`)
    REFERENCES `online_shop`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) INVISIBLE,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `online_shop`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`roles` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_roles_users`
    FOREIGN KEY (`id`)
    REFERENCES `online_shop`.`users` (`role_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `online_shop`.`types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`types` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`)
  )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `online_shop`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`categories` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type_id` INT NOT NULL,
  `category_name` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_id_products`
    FOREIGN KEY (`id`)
    REFERENCES `online_shop`.`products` (`category_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_services`
    FOREIGN KEY (`id`)
    REFERENCES `online_shop`.`services` (`category_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
CONSTRAINT `fk_type_typeid`
    FOREIGN KEY (`type_id`)
    REFERENCES `online_shop`.`types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `online_shop`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`products` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category_id` INT NOT NULL,
  `name` VARCHAR(60) NOT NULL,
  `price` DECIMAL NOT NULL,
  `description` LONGTEXT NOT NULL,
  `picture` BLOB NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_category_products`
	FOREIGN KEY (`category_id`)
    REFERENCES `online_shop`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `online_shop`.`services`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`services` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`services` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category_id` INT NOT NULL,
  `name` VARCHAR(60) NOT NULL,
  `price` DECIMAL NOT NULL,
  `description` LONGTEXT NOT NULL,
  `picture` BLOB NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_category_services`
	FOREIGN KEY (`category_id`)
    REFERENCES `online_shop`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

-- -----------------------------------------------------
-- Table `online_shop`.`shopping_carts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`shopping_carts` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`shopping_carts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_user_cart`
	FOREIGN KEY (`user_id`)
    REFERENCES `online_shop`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `online_shop`.`products_in_cart`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`products_in_cart` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`products_in_cart` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cart_id` INT NOT NULL,
  `type_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_owner_cart`
	FOREIGN KEY (`cart_id`)
    REFERENCES `online_shop`.`shopping_carts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
CONSTRAINT `fk_type_cart`
	FOREIGN KEY (`type_id`)
    REFERENCES `online_shop`.`types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_cart`
	FOREIGN KEY (`product_id`)
    REFERENCES `online_shop`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `online_shop`.`purchases`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`purchases` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`purchases` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cart_id` INT NOT NULL,
  `date` DATE NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_cart_purchased`
	FOREIGN KEY (`cart_id`)
    REFERENCES `online_shop`.`shopping_carts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;