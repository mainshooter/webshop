-- MySQL Script generated by MySQL Workbench
-- Wed May 17 08:45:57 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema multiversum
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema multiversum
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `multiversum` DEFAULT CHARACTER SET utf8 ;
USE `multiversum` ;

-- -----------------------------------------------------
-- Table `multiversum`.`Fabrikant`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `multiversum`.`Fabrikant` (
  `idFabrikant` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(80) NOT NULL,
  `straat` VARCHAR(100) NULL,
  `nummer` INT NULL,
  `postcode` CHAR(6) NULL,
  `email` VARCHAR(80) NULL,
  `telefoonnummer` VARCHAR(45) NULL,
  PRIMARY KEY (`idFabrikant`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiversum`.`Categorie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `multiversum`.`Categorie` (
  `idCategorie` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCategorie`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiversum`.`Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `multiversum`.`Product` (
  `idProduct` INT NOT NULL AUTO_INCREMENT,
  `Fabrikant_idFabrikant` INT NULL,
  `naam` VARCHAR(45) NOT NULL,
  `prijs` DECIMAL(18,4) NOT NULL,
  `beschrijving` VARCHAR(45) NOT NULL,
  `Categorie_idCategorie` INT NULL,
  PRIMARY KEY (`idProduct`),
  INDEX `fk_Product_Fabrikant_idx` (`Fabrikant_idFabrikant` ASC),
  INDEX `fk_Product_Categorie1_idx` (`Categorie_idCategorie` ASC),
  CONSTRAINT `fk_Product_Fabrikant`
    FOREIGN KEY (`Fabrikant_idFabrikant`)
    REFERENCES `multiversum`.`Fabrikant` (`idFabrikant`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Product_Categorie1`
    FOREIGN KEY (`Categorie_idCategorie`)
    REFERENCES `multiversum`.`Categorie` (`idCategorie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiversum`.`betaal_methode`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `multiversum`.`betaal_methode` (
  `idbetaal_methode` INT NOT NULL,
  `betaalmethode` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idbetaal_methode`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiversum`.`Order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `multiversum`.`Order` (
  `idOrder` INT NOT NULL AUTO_INCREMENT,
  `klant_voornaam` VARCHAR(45) NOT NULL,
  `klant_achternaam` VARCHAR(45) NOT NULL,
  `klant_tussenvoegsel` VARCHAR(45) NULL,
  `klant_straat` VARCHAR(45) NOT NULL,
  `klant_huisnummer` VARCHAR(45) NOT NULL,
  `klant_postcode` VARCHAR(45) NOT NULL,
  `klant_email` VARCHAR(45) NOT NULL,
  `verstuur_status` VARCHAR(45) NULL,
  `betaal_status` VARCHAR(45) NULL,
  `betaal_methode_idbetaal_methode` INT NOT NULL,
  `klant_huisnummertoevoegingen` VARCHAR(45) NULL,
  PRIMARY KEY (`idOrder`),
  INDEX `fk_Order_betaal_methode1_idx` (`betaal_methode_idbetaal_methode` ASC),
  CONSTRAINT `fk_Order_betaal_methode1`
    FOREIGN KEY (`betaal_methode_idbetaal_methode`)
    REFERENCES `multiversum`.`betaal_methode` (`idbetaal_methode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiversum`.`order_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `multiversum`.`order_item` (
  `idorder_item` INT NOT NULL AUTO_INCREMENT,
  `Order_idOrder` INT NOT NULL,
  `prijs` INT NOT NULL,
  `Product_idProduct` INT NOT NULL,
  `aantal` INT NOT NULL,
  PRIMARY KEY (`idorder_item`),
  INDEX `fk_order_item_Order1_idx` (`Order_idOrder` ASC),
  INDEX `fk_order_item_Product1_idx` (`Product_idProduct` ASC),
  CONSTRAINT `fk_order_item_Order1`
    FOREIGN KEY (`Order_idOrder`)
    REFERENCES `multiversum`.`Order` (`idOrder`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_item_Product1`
    FOREIGN KEY (`Product_idProduct`)
    REFERENCES `multiversum`.`Product` (`idProduct`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiversum`.`Verkoper`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `multiversum`.`Verkoper` (
  `idVerkoper` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `wachtwoord` VARCHAR(45) NOT NULL,
  `voornaam` VARCHAR(45) NOT NULL,
  `achternaam` VARCHAR(45) NOT NULL,
  `tussenvoegsel` VARCHAR(45) NULL,
  PRIMARY KEY (`idVerkoper`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiversum`.`files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `multiversum`.`files` (
  `idfiles` INT NOT NULL AUTO_INCREMENT,
  `filenaam` VARCHAR(45) NOT NULL,
  `pad` TEXT NULL,
  `extensie` VARCHAR(45) NULL,
  PRIMARY KEY (`idfiles`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiversum`.`files_has_Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `multiversum`.`files_has_Product` (
  `files_idfiles` INT NOT NULL,
  `Product_idProduct` INT NOT NULL,
  `idfiles_has_Product` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idfiles_has_Product`),
  INDEX `fk_files_has_Product_Product1_idx` (`Product_idProduct` ASC),
  INDEX `fk_files_has_Product_files1_idx` (`files_idfiles` ASC),
  CONSTRAINT `fk_files_has_Product_files1`
    FOREIGN KEY (`files_idfiles`)
    REFERENCES `multiversum`.`files` (`idfiles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_files_has_Product_Product1`
    FOREIGN KEY (`Product_idProduct`)
    REFERENCES `multiversum`.`Product` (`idProduct`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `multiversum`.`Specificatie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `multiversum`.`Specificatie` (
  `idSpecificatie` INT NOT NULL AUTO_INCREMENT,
  `Specificatie_naam` VARCHAR(80) NULL,
  `Specificatie_waarde` VARCHAR(45) NULL,
  `Product_idProduct` INT NOT NULL,
  PRIMARY KEY (`idSpecificatie`),
  INDEX `fk_Specificatie_Product1_idx` (`Product_idProduct` ASC),
  CONSTRAINT `fk_Specificatie_Product1`
    FOREIGN KEY (`Product_idProduct`)
    REFERENCES `multiversum`.`Product` (`idProduct`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
