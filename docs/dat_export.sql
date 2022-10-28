-- MySQL Script generated by MySQL Workbench
-- Fri Oct 28 10:11:08 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema wheel_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema wheel_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `wheel_db` DEFAULT CHARACTER SET utf8 ;
USE `wheel_db` ;

-- -----------------------------------------------------
-- Table `wheel_db`.`lobby`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wheel_db`.`lobby` (
  `lobbyID` INT NOT NULL AUTO_INCREMENT,
  `accessCode` VARCHAR(8) NOT NULL,
  `playerCount` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`lobbyID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wheel_db`.`prompt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wheel_db`.`prompt` (
  `promptID` INT NOT NULL AUTO_INCREMENT,
  `lobbyID` INT NOT NULL,
  `prompt` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`promptID`),
  INDEX `lobbyID_idx` (`lobbyID` ASC) VISIBLE,
  FOREIGN KEY (`lobbyID`)
    REFERENCES `wheel_db`.`lobby` (`lobbyID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wheel_db`.`player`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wheel_db`.`player` (
  `playerID` INT NOT NULL AUTO_INCREMENT,
  `lobbyID` INT NOT NULL,
  `playerName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`playerID`),
  INDEX `lobby-player_idx` (`lobbyID` ASC) VISIBLE,
  CONSTRAINT `lobby-player`
    FOREIGN KEY (`lobbyID`)
    REFERENCES `wheel_db`.`lobby` (`lobbyID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wheel_db`.`picture`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wheel_db`.`picture` (
  `pictureID` INT NOT NULL AUTO_INCREMENT,
  `promptID` INT NOT NULL,
  `playerID` INT NOT NULL,
  `picture` MEDIUMBLOB NOT NULL,
  PRIMARY KEY (`pictureID`),
  INDEX `prompt-picture_idx` (`promptID` ASC) VISIBLE,
  INDEX `player-picture_idx` (`playerID` ASC) VISIBLE,
  CONSTRAINT `prompt-picture`
    FOREIGN KEY (`promptID`)
    REFERENCES `wheel_db`.`prompt` (`promptID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `player-picture`
    FOREIGN KEY (`playerID`)
    REFERENCES `wheel_db`.`player` (`playerID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;