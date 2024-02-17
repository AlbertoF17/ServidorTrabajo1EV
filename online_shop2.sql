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
-- Table `online_shop`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`roles` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`)
  )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

INSERT INTO roles (id, role) VALUES (0, "admin");
INSERT INTO roles (id, role) VALUES (0, "user");


-- -----------------------------------------------------
-- Table `online_shop`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`users` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `roleId` INT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phoneNumber` VARCHAR(45) NOT NULL,
  `password` CHAR(60) NOT NULL,
  `streetNumber` VARCHAR(20),
  `street` VARCHAR(100) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `region` VARCHAR(100),
  `country` VARCHAR(100) NOT NULL,
  `postalCode` VARCHAR(20) NOT NULL,
  `createDate` DATE NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`roleId`)
    REFERENCES `online_shop`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) INVISIBLE,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE)
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

INSERT INTO types VALUES (0, "Prodcuts");
INSERT INTO types VALUES (0, "Services");


-- -----------------------------------------------------
-- Table `online_shop`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`categories` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type_id` INT NOT NULL,
  `category_name` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`),
CONSTRAINT `fk_type_typeid`
    FOREIGN KEY (`type_id`)
    REFERENCES `online_shop`.`types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

INSERT INTO categories VALUES (0, 1,"Components");
INSERT INTO categories VALUES (0, 1,"Peripherals");
INSERT INTO categories VALUES (0, 1,"Keys");
INSERT INTO categories VALUES (0, 2,"Design a website");
INSERT INTO categories VALUES (0, 2,"Check and upgrade PC's preformance");
INSERT INTO categories VALUES (0, 2,"Install drivers and programs");
INSERT INTO categories VALUES (0, 2,"PC repair");
INSERT INTO categories VALUES (0, 2,"Bug fixes");
INSERT INTO categories VALUES (0, 2,"Website maintenance");

-- -----------------------------------------------------
-- Table `online_shop`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `online_shop`.`products` ;

CREATE TABLE IF NOT EXISTS `online_shop`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `categoryId` INT NOT NULL,
  `name` VARCHAR(60) NOT NULL,
  `price` FLOAT NOT NULL,
  `description` LONGTEXT NOT NULL,
  `image` LONGBLOB NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_category_products`
	FOREIGN KEY (`categoryId`)
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
  `categoryId` INT NOT NULL,
  `name` VARCHAR(60) NOT NULL,
  `price` FLOAT NOT NULL,
  `description` LONGTEXT NOT NULL,
  `image` LONGBLOB NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_category_services`
	FOREIGN KEY (`categoryId`)
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