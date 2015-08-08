-- MySQL Script generated by MySQL Workbench
-- 08/08/15 18:26:30
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema NUMERACY
-- -----------------------------------------------------
-- NUMERACY DATABASE
DROP SCHEMA IF EXISTS `NUMERACY` ;

-- -----------------------------------------------------
-- Schema NUMERACY
--
-- NUMERACY DATABASE
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `NUMERACY` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `NUMERACY` ;

-- -----------------------------------------------------
-- Table `NUMERACY`.`M01_USER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M01_USER` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M01_USER` (
  `M01USERID` INT NOT NULL AUTO_INCREMENT COMMENT 'SEQUENCE ID - AUTO INCREMENT',
  `USERID` VARCHAR(45) NULL COMMENT '',
  `PASSWORD` VARCHAR(250) NOT NULL COMMENT 'ENCRYPTED PASSWORD',
  `FIRSTNAME` VARCHAR(45) NULL COMMENT '',
  `LASTNAME` VARCHAR(45) NULL COMMENT '',
  `MIDDLENAME` VARCHAR(45) NULL COMMENT '',
  `NICKNAME` VARCHAR(45) NULL COMMENT '',
  `GENDER` CHAR(1) NULL COMMENT '',
  `DOB` VARCHAR(12) NULL COMMENT '',
  `COUNTRYCODE` INT NULL COMMENT '',
  `STDCODE` INT NULL COMMENT '',
  `PHONE` INT NULL COMMENT 'LAND LINE',
  `MOBILE` INT NULL COMMENT '',
  `EMAIL1` VARCHAR(100) NOT NULL COMMENT '',
  `EMAIL2` VARCHAR(45) NULL COMMENT '',
  `STATUS` INT NULL COMMENT 'LINKS TO STATUS CODE TABLE',
  `CREATEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `MODIFIEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  PRIMARY KEY (`M01USERID`)  COMMENT '')
ENGINE = InnoDB
COMMENT = '			';


-- -----------------------------------------------------
-- Table `NUMERACY`.`M11_STATUS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M11_STATUS` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M11_STATUS` (
  `M11STATUSID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `CODE` VARCHAR(20) NOT NULL COMMENT 'Example :  status code for user are  unregistered, active, inactive,',
  `LABEL` VARCHAR(100) NOT NULL COMMENT '',
  `CREATEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `CREATEBY` VARCHAR(45) NULL DEFAULT 'ADMIN' COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`M11STATUSID`)  COMMENT '',
  UNIQUE INDEX `CODE_UNIQUE` (`CODE` ASC)  COMMENT '',
  UNIQUE INDEX `M11STATUSID_UNIQUE` (`M11STATUSID` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`M02_CATEGORY`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M02_CATEGORY` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M02_CATEGORY` (
  `M02CATEGORYID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `LABEL` VARCHAR(100) NOT NULL COMMENT '',
  `M11STATUSID` INT NULL COMMENT '',
  `STARTAGE` INT NULL COMMENT 'START AGE OF THE CATEGORY',
  `ENDAGE` INT NULL COMMENT 'END AGE OF THE CATEGORY',
  `GENDER` CHAR(1) NULL COMMENT '',
  `CREATEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL DEFAULT 'ADMIN' COMMENT '',
  `MODIFIEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`M02CATEGORYID`)  COMMENT '',
  UNIQUE INDEX `LABEL_UNIQUE` (`LABEL` ASC)  COMMENT '',
  UNIQUE INDEX `M02CATEGORYID_UNIQUE` (`M02CATEGORYID` ASC)  COMMENT '',
  INDEX `FK_M02_M11STATUSID_idx` (`M11STATUSID` ASC)  COMMENT '',
  CONSTRAINT `FK_M02_M11STATUSID`
    FOREIGN KEY (`M11STATUSID`)
    REFERENCES `NUMERACY`.`M11_STATUS` (`M11STATUSID`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`M04_CHAPTER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M04_CHAPTER` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M04_CHAPTER` (
  `M04CHAPTERID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `CHAPTERNAME` VARCHAR(150) NOT NULL COMMENT 'Chapter Name',
  `CHAPTERNUMBER` INT NULL COMMENT '',
  `M11STATUSID` INT NULL COMMENT '',
  `DESC` VARCHAR(1000) NULL COMMENT 'Chapter description',
  `SHORTDESC` VARCHAR(150) NULL COMMENT 'Short Description',
  `CREATEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `CREATEDBY` VARCHAR(50) NULL DEFAULT 'ADMIN' COMMENT '',
  `MODIFIEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL DEFAULT 'ADMIN' COMMENT '',
  PRIMARY KEY (`M04CHAPTERID`)  COMMENT '',
  INDEX `FK_M04_M11STATUSID_idx` (`M11STATUSID` ASC)  COMMENT '',
  CONSTRAINT `FK_M04_M11STATUSID`
    FOREIGN KEY (`M11STATUSID`)
    REFERENCES `NUMERACY`.`M11_STATUS` (`M11STATUSID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '	';


-- -----------------------------------------------------
-- Table `NUMERACY`.`M05_LESSON`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M05_LESSON` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M05_LESSON` (
  `M05LESSONID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `TITLE` VARCHAR(250) NOT NULL COMMENT 'TITLE OF THE LESSON',
  `LONGDESC` VARCHAR(1000) NULL COMMENT '',
  `SHORTDESC` VARCHAR(250) NULL COMMENT '',
  `ADDITIONALINFO` VARCHAR(500) NULL COMMENT '',
  `CREATEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL DEFAULT 'ADMIN' COMMENT '',
  `MODIFIEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL DEFAULT 'ADMIN' COMMENT '',
  PRIMARY KEY (`M05LESSONID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`M09_MESSAGE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M09_MESSAGE` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M09_MESSAGE` (
  `M09MESSAGEID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `MSGCODE` VARCHAR(15) NULL COMMENT 'EXAMPLE : LE0001\nIO0002\n',
  `MSGTXT` VARCHAR(500) NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`M09MESSAGEID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`M07_ADDRESS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M07_ADDRESS` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M07_ADDRESS` (
  `M07ADDRESSID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `TYPE` VARCHAR(45) NOT NULL COMMENT '',
  `CODE` VARCHAR(45) NOT NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  PRIMARY KEY (`M07ADDRESSID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`M08_MENU`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M08_MENU` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M08_MENU` (
  `M08MENUID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `LABEL` VARCHAR(250) NULL COMMENT 'DISPLAY LABLE OF THE MENU',
  `PARENTID` INT NULL COMMENT 'PARENT ID OF THE MENU, FOR TOP LEVEL MENUS INSERT 0',
  `URL` VARCHAR(500) NULL COMMENT 'EXTERNAL URL LINKS',
  `ICON` VARCHAR(250) NULL COMMENT 'MENU ICON PHYSICAL PATH',
  `DESC` VARCHAR(250) NULL COMMENT '',
  `VISIBLE` TINYINT(1) NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`M08MENUID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`M03_LEVEL`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M03_LEVEL` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M03_LEVEL` (
  `M03LEVELID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `LABEL` VARCHAR(100) NOT NULL COMMENT '',
  `M11STATUSID` INT NULL COMMENT '',
  `CREATEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL DEFAULT 'ADMIN' COMMENT '',
  `MODIFIEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`M03LEVELID`)  COMMENT '',
  UNIQUE INDEX `M03LEVELID_UNIQUE` (`M03LEVELID` ASC)  COMMENT '',
  UNIQUE INDEX `LABEL_UNIQUE` (`LABEL` ASC)  COMMENT '',
  INDEX `FK_M03_M11STATUSID_idx` (`M11STATUSID` ASC)  COMMENT '',
  CONSTRAINT `FK_M03_M11STATUSID`
    FOREIGN KEY (`M11STATUSID`)
    REFERENCES `NUMERACY`.`M11_STATUS` (`M11STATUSID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T01_CATEGORY_LEVEL`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T01_CATEGORY_LEVEL` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T01_CATEGORY_LEVEL` (
  `T01CATEGORYLEVELID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M02CATEGORYID` INT NULL COMMENT '',
  `M03LEVELID` INT NULL COMMENT '',
  `LONGDESC` VARCHAR(500) NULL COMMENT '',
  `SHORTDESC` VARCHAR(150) NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  PRIMARY KEY (`T01CATEGORYLEVELID`)  COMMENT '',
  INDEX `FK_CAT_ID_idx` (`M02CATEGORYID` ASC)  COMMENT '',
  INDEX `FK_LEV_ID_idx` (`M03LEVELID` ASC)  COMMENT '',
  CONSTRAINT `FK_M02CATEGORYID`
    FOREIGN KEY (`M02CATEGORYID`)
    REFERENCES `NUMERACY`.`M02_CATEGORY` (`M02CATEGORYID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_M03LEVELID`
    FOREIGN KEY (`M03LEVELID`)
    REFERENCES `NUMERACY`.`M03_LEVEL` (`M03LEVELID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T02_USER_CATEGORY`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T02_USER_CATEGORY` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T02_USER_CATEGORY` (
  `T02USERCATEGORYID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M01USERID` INT NULL COMMENT '',
  `M02CATEGORYID` INT NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  PRIMARY KEY (`T02USERCATEGORYID`)  COMMENT '',
  INDEX `FK_T02_UID_idx` (`M01USERID` ASC)  COMMENT '',
  INDEX `FK_T02_CID_idx` (`M02CATEGORYID` ASC)  COMMENT '',
  CONSTRAINT `FK_T02_M01USERID`
    FOREIGN KEY (`M01USERID`)
    REFERENCES `NUMERACY`.`M01_USER` (`M01USERID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T02_M02CATEGORYID`
    FOREIGN KEY (`M02CATEGORYID`)
    REFERENCES `NUMERACY`.`M02_CATEGORY` (`M02CATEGORYID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T03_USER_CAT_LEVEL`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T03_USER_CAT_LEVEL` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T03_USER_CAT_LEVEL` (
  `T03USERCATEGORYLEVELID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `T02USERCATEGORYID` INT NULL COMMENT 'USER CATEGORY TABLE ID',
  `T01CATEGORYLEVELID` INT NULL COMMENT 'CATEGORY LEVEL TABLE ID',
  `CREATEDON` DATETIME NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `FAVORITE` TINYINT(1) NULL COMMENT '',
  `SKIPPED` TINYINT(1) NULL COMMENT '',
  PRIMARY KEY (`T03USERCATEGORYLEVELID`)  COMMENT '',
  INDEX `FK_T03_CL_ID_idx` (`T01CATEGORYLEVELID` ASC)  COMMENT '',
  INDEX `FK_T03_UCID_idx` (`T02USERCATEGORYID` ASC)  COMMENT '',
  CONSTRAINT `FK_T03_T02USERCATEGORYID`
    FOREIGN KEY (`T02USERCATEGORYID`)
    REFERENCES `NUMERACY`.`T02_USER_CATEGORY` (`T02USERCATEGORYID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T03_T01CATEGORYLEVELID`
    FOREIGN KEY (`T01CATEGORYLEVELID`)
    REFERENCES `NUMERACY`.`T01_CATEGORY_LEVEL` (`T01CATEGORYLEVELID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T04_CAT_LEV_CHAP`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T04_CAT_LEV_CHAP` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T04_CAT_LEV_CHAP` (
  `T04CATEGORYLEVELCHAPID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `T01CATEGORYLEVELID` INT NULL COMMENT '',
  `M04CHAPTERID` INT NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  PRIMARY KEY (`T04CATEGORYLEVELCHAPID`)  COMMENT '',
  INDEX `FK_T04_CLID_idx` (`T01CATEGORYLEVELID` ASC)  COMMENT '',
  INDEX `FK_T04_CHAPID_idx` (`M04CHAPTERID` ASC)  COMMENT '',
  CONSTRAINT `FK_T04_T01CATEGORYLEVELID`
    FOREIGN KEY (`T01CATEGORYLEVELID`)
    REFERENCES `NUMERACY`.`T01_CATEGORY_LEVEL` (`T01CATEGORYLEVELID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T04_M04CHAPTERID`
    FOREIGN KEY (`M04CHAPTERID`)
    REFERENCES `NUMERACY`.`M04_CHAPTER` (`M04CHAPTERID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T05_CAT_LEV_CHAP_LESS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T05_CAT_LEV_CHAP_LESS` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T05_CAT_LEV_CHAP_LESS` (
  `T05CATEGORYLEVECHAPLESSLID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `T04CATEGORYLEVELCHAPID` INT NULL COMMENT '',
  `M05LESSONID` INT NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`T05CATEGORYLEVECHAPLESSLID`)  COMMENT '',
  INDEX `FK_T05_CLCID_idx` (`T04CATEGORYLEVELCHAPID` ASC)  COMMENT '',
  INDEX `FK_T05_LID_idx` (`M05LESSONID` ASC)  COMMENT '',
  CONSTRAINT `FK_T05_T04CATEGORYLEVELCHAPID`
    FOREIGN KEY (`T04CATEGORYLEVELCHAPID`)
    REFERENCES `NUMERACY`.`T04_CAT_LEV_CHAP` (`T04CATEGORYLEVELCHAPID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T05_M05LESSONID`
    FOREIGN KEY (`M05LESSONID`)
    REFERENCES `NUMERACY`.`M05_LESSON` (`M05LESSONID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T06_USER_CAT_LEVEL_CHAP`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T06_USER_CAT_LEVEL_CHAP` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T06_USER_CAT_LEVEL_CHAP` (
  `T06USERCATEGORYLEVELCHAPID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `T03USERCATEGORYLEVELID` INT NULL COMMENT 'USER CATEGORY LEVEL ID',
  `T04CATEGORYLEVELCHAPID` INT NULL COMMENT 'CATEGORY LEVEL CHAPTER ID',
  `CREATED ON` DATETIME NULL COMMENT '',
  `MODIFIED ON` DATETIME NULL COMMENT '',
  `FAVORITE` TINYINT(1) NULL COMMENT '',
  `SKIPPED` TINYINT(1) NULL COMMENT '',
  PRIMARY KEY (`T06USERCATEGORYLEVELCHAPID`)  COMMENT '',
  INDEX `FK_T06_UCLID_idx` (`T03USERCATEGORYLEVELID` ASC)  COMMENT '',
  INDEX `FK_T06_CLCID_idx` (`T04CATEGORYLEVELCHAPID` ASC)  COMMENT '',
  CONSTRAINT `FK_T06_T03USERCATEGORYLEVELID`
    FOREIGN KEY (`T03USERCATEGORYLEVELID`)
    REFERENCES `NUMERACY`.`T03_USER_CAT_LEVEL` (`T03USERCATEGORYLEVELID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T06_T04CATEGORYLEVELCHAPID`
    FOREIGN KEY (`T04CATEGORYLEVELCHAPID`)
    REFERENCES `NUMERACY`.`T04_CAT_LEV_CHAP` (`T04CATEGORYLEVELCHAPID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T07_USER_CAT_LEV_CHAP_LESS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T07_USER_CAT_LEV_CHAP_LESS` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T07_USER_CAT_LEV_CHAP_LESS` (
  `T07USERCATEGORYLEVELCHAPLESSID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `T06USERCATEGORYLEVELCHAPID` INT NULL COMMENT 'T06 USER CAT LEVEL CHAP ID',
  `T05CATEGORYLEVECHAPLESSLID` INT NULL COMMENT 'T05 CAT LEV CHAP LESS ID',
  `FAVORITE` TINYINT(1) NULL COMMENT '',
  `SKIPPED` TINYINT(1) NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  PRIMARY KEY (`T07USERCATEGORYLEVELCHAPLESSID`)  COMMENT '',
  INDEX `FK_T07_UCLCID_idx` (`T06USERCATEGORYLEVELCHAPID` ASC)  COMMENT '',
  INDEX `FK_T07_CLCLID_idx` (`T05CATEGORYLEVECHAPLESSLID` ASC)  COMMENT '',
  CONSTRAINT `FK_T07_T06USERCATEGORYLEVELCHAPID`
    FOREIGN KEY (`T06USERCATEGORYLEVELCHAPID`)
    REFERENCES `NUMERACY`.`T06_USER_CAT_LEVEL_CHAP` (`T06USERCATEGORYLEVELCHAPID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T07_T05CATEGORYLEVECHAPLESSLID`
    FOREIGN KEY (`T05CATEGORYLEVECHAPLESSLID`)
    REFERENCES `NUMERACY`.`T05_CAT_LEV_CHAP_LESS` (`T05CATEGORYLEVECHAPLESSLID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`M10_FILE_TYPE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M10_FILE_TYPE` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M10_FILE_TYPE` (
  `M10TYPEID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `LABLE` VARCHAR(150) NULL COMMENT 'EXAMPLE :  IMAGE, AUDIO,VIDEO ETC',
  `CREATEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`M10TYPEID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`M06_FILE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M06_FILE` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M06_FILE` (
  `M06FILEID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `FILENAME` VARCHAR(200) NOT NULL COMMENT '',
  `M10TYPEID` INT NULL COMMENT '',
  `EXTENSION` VARCHAR(10) NULL COMMENT '',
  `SIZE` VARCHAR(45) NULL COMMENT '',
  `URL` VARCHAR(250) NULL COMMENT '',
  `PATH` VARCHAR(250) NULL COMMENT '',
  `TAGS` VARCHAR(200) NULL COMMENT '',
  `CREATEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL DEFAULT 'ADMIN' COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`M06FILEID`)  COMMENT '',
  INDEX `FK_M10TYPEID_idx` (`M10TYPEID` ASC)  COMMENT '',
  CONSTRAINT `FK_M10TYPEID`
    FOREIGN KEY (`M10TYPEID`)
    REFERENCES `NUMERACY`.`M10_FILE_TYPE` (`M10TYPEID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T10_USER_ADDRESS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T10_USER_ADDRESS` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T10_USER_ADDRESS` (
  `T10USERADDRESSID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M01USERID` INT NULL COMMENT '',
  `M07ADDRESSID` INT NULL COMMENT '',
  `ADDRESS1` VARCHAR(150) NULL COMMENT '',
  `ADDRESS2` VARCHAR(150) NULL COMMENT '',
  `ADDRESS3` VARCHAR(150) NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  PRIMARY KEY (`T10USERADDRESSID`)  COMMENT '',
  INDEX `FK_T10_UID_idx` (`M01USERID` ASC)  COMMENT '',
  INDEX `FK_T10_AID_idx` (`M07ADDRESSID` ASC)  COMMENT '',
  CONSTRAINT `FK_T10_M01USERID`
    FOREIGN KEY (`M01USERID`)
    REFERENCES `NUMERACY`.`M01_USER` (`M01USERID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T10_M07ADDRESSID`
    FOREIGN KEY (`M07ADDRESSID`)
    REFERENCES `NUMERACY`.`M07_ADDRESS` (`M07ADDRESSID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T08_LESS_FILE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T08_LESS_FILE` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T08_LESS_FILE` (
  `T08LESSFILEID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M05LESSONID` INT NULL COMMENT '',
  `M06FILEID` INT NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`T08LESSFILEID`)  COMMENT '',
  INDEX `FK_T08_LID_idx` (`M05LESSONID` ASC)  COMMENT '',
  INDEX `FK_T08_FID_idx` (`M06FILEID` ASC)  COMMENT '',
  CONSTRAINT `FK_T08_M05LESSONID`
    FOREIGN KEY (`M05LESSONID`)
    REFERENCES `NUMERACY`.`M05_LESSON` (`M05LESSONID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T08_M06FILEID`
    FOREIGN KEY (`M06FILEID`)
    REFERENCES `NUMERACY`.`M06_FILE` (`M06FILEID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T09_USER_PROGRESS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T09_USER_PROGRESS` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T09_USER_PROGRESS` (
  `T09USERPROGRESSID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M01USERID` INT NOT NULL COMMENT 'USER ID',
  `T02USERCATEGORYID` INT NULL COMMENT '',
  `T03USERCATEGORYLEVELID` INT NULL COMMENT '',
  `T06USERCATEGORYLEVELCHAPID` INT NULL COMMENT '',
  `T07USERCATEGORYLEVELCHAPLESSID` INT NULL COMMENT '',
  PRIMARY KEY (`T09USERPROGRESSID`)  COMMENT '',
  INDEX `FK09_M01USERID_idx` (`M01USERID` ASC)  COMMENT '',
  INDEX `FK09_T02USERCATEGORYID_idx` (`T02USERCATEGORYID` ASC)  COMMENT '',
  INDEX `FK09_T03USERCATEGORYLEVELID_idx` (`T03USERCATEGORYLEVELID` ASC)  COMMENT '',
  INDEX `FK09_T06USERCATEGORYLEVELCHAPID_idx` (`T06USERCATEGORYLEVELCHAPID` ASC)  COMMENT '',
  INDEX `FK09_T07USERCATEGORYLEVELCHAPLESSID_idx` (`T07USERCATEGORYLEVELCHAPLESSID` ASC)  COMMENT '',
  CONSTRAINT `FK09_M01USERID`
    FOREIGN KEY (`M01USERID`)
    REFERENCES `NUMERACY`.`M01_USER` (`M01USERID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK09_T02USERCATEGORYID`
    FOREIGN KEY (`T02USERCATEGORYID`)
    REFERENCES `NUMERACY`.`T02_USER_CATEGORY` (`T02USERCATEGORYID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK09_T03USERCATEGORYLEVELID`
    FOREIGN KEY (`T03USERCATEGORYLEVELID`)
    REFERENCES `NUMERACY`.`T03_USER_CAT_LEVEL` (`T03USERCATEGORYLEVELID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK09_T06USERCATEGORYLEVELCHAPID`
    FOREIGN KEY (`T06USERCATEGORYLEVELCHAPID`)
    REFERENCES `NUMERACY`.`T06_USER_CAT_LEVEL_CHAP` (`T06USERCATEGORYLEVELCHAPID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK09_T07USERCATEGORYLEVELCHAPLESSID`
    FOREIGN KEY (`T07USERCATEGORYLEVELCHAPLESSID`)
    REFERENCES `NUMERACY`.`T07_USER_CAT_LEV_CHAP_LESS` (`T07USERCATEGORYLEVELCHAPLESSID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T11_USER_SETTINGS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T11_USER_SETTINGS` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T11_USER_SETTINGS` (
  `T11USERSETTINGSID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M01USERID` INT NULL COMMENT '',
  `STATUSMSG` VARCHAR(150) NULL COMMENT '',
  PRIMARY KEY (`T11USERSETTINGSID`)  COMMENT '',
  INDEX `FK_M01USERID_idx` (`M01USERID` ASC)  COMMENT '',
  CONSTRAINT `FK_T11_M01USERID`
    FOREIGN KEY (`M01USERID`)
    REFERENCES `NUMERACY`.`M01_USER` (`M01USERID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T12_USER_SESSION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T12_USER_SESSION` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T12_USER_SESSION` (
  `T12USERSESSIONSID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M01USERID` INT NULL COMMENT '',
  `IPADDRESS` VARCHAR(45) NULL COMMENT '',
  `LOCATION` VARCHAR(100) NULL COMMENT '',
  `BROWSER` VARCHAR(100) NULL COMMENT '',
  `DEVICE` VARCHAR(100) NULL COMMENT '',
  `OPERATOR` VARCHAR(100) NULL COMMENT '',
  `LOGINTIME` DATETIME NULL COMMENT '',
  PRIMARY KEY (`T12USERSESSIONSID`)  COMMENT '',
  INDEX `FK_T12_M01USERID_idx` (`M01USERID` ASC)  COMMENT '',
  CONSTRAINT `FK_T12_M01USERID`
    FOREIGN KEY (`M01USERID`)
    REFERENCES `NUMERACY`.`M01_USER` (`M01USERID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T13_ACTIVATION_CODE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T13_ACTIVATION_CODE` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T13_ACTIVATION_CODE` (
  `T13ACTIVATIONCODEID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `CODE` VARCHAR(50) NULL COMMENT '',
  `EMAIL` VARCHAR(100) NULL COMMENT '',
  `MOBILE` VARCHAR(15) NULL COMMENT '',
  `CODESENTON` DATETIME NULL COMMENT '',
  `STATUS` VARCHAR(45) NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `CODESENTTO` VARCHAR(150) NULL COMMENT 'CODE SENT TO MOBILE AND/OR EMAIL',
  PRIMARY KEY (`T13ACTIVATIONCODEID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T14_CATEGORY_FILE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T14_CATEGORY_FILE` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T14_CATEGORY_FILE` (
  `T14CATEGORYFILEID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M02CATEGORYID` INT NULL COMMENT '',
  `M06FILEID` INT NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`T14CATEGORYFILEID`)  COMMENT '',
  INDEX `FK_T08_FID_idx` (`M06FILEID` ASC)  COMMENT '',
  INDEX `FK_T08_M02CATEGORYID_idx` (`M02CATEGORYID` ASC)  COMMENT '',
  CONSTRAINT `FK_T08_M02CATEGORYID`
    FOREIGN KEY (`M02CATEGORYID`)
    REFERENCES `NUMERACY`.`M02_CATEGORY` (`M02CATEGORYID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T08_M06FILEID0`
    FOREIGN KEY (`M06FILEID`)
    REFERENCES `NUMERACY`.`M06_FILE` (`M06FILEID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T15_CHAP_FILE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T15_CHAP_FILE` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T15_CHAP_FILE` (
  `T15CHAPFILEID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M04CHAPTERID` INT NULL COMMENT '',
  `M06FILEID` INT NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`T15CHAPFILEID`)  COMMENT '',
  INDEX `FK_T08_FID_idx` (`M06FILEID` ASC)  COMMENT '',
  INDEX `FK_T08_M04CHAPTERID_idx` (`M04CHAPTERID` ASC)  COMMENT '',
  CONSTRAINT `FK_T08_M04CHAPTERID`
    FOREIGN KEY (`M04CHAPTERID`)
    REFERENCES `NUMERACY`.`M04_CHAPTER` (`M04CHAPTERID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T08_M06FILEID00`
    FOREIGN KEY (`M06FILEID`)
    REFERENCES `NUMERACY`.`M06_FILE` (`M06FILEID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`M12_QUESTION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M12_QUESTION` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M12_QUESTION` (
  `M12QUESTIONID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `DESCRIPTION` VARCHAR(500) NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  `ACTIVE` TINYINT(1) NULL DEFAULT 1 COMMENT '',
  PRIMARY KEY (`M12QUESTIONID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`M13_ANSWER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M13_ANSWER` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M13_ANSWER` (
  `M13ANSWERID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `DESCRIPTION` VARCHAR(500) NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  `ACTIVE` TINYINT(1) NULL DEFAULT 1 COMMENT '',
  `TEXTANSWER` VARCHAR(100) NULL COMMENT 'ANSWER IN TEXT FORMAT FOR VALIDIATION',
  PRIMARY KEY (`M13ANSWERID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T16_QUESTION_ANSWER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T16_QUESTION_ANSWER` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T16_QUESTION_ANSWER` (
  `T16QUESTIONANSWERID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M12QUESTIONID` INT NULL COMMENT '',
  `M13ANSWERID` INT NULL COMMENT '',
  `DESCRIPTION` VARCHAR(500) NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`T16QUESTIONANSWERID`)  COMMENT '',
  INDEX `FK_T16_M12QUESTIONID_idx` (`M12QUESTIONID` ASC)  COMMENT '',
  INDEX `FK_T16_M13ANSWERID_idx` (`M13ANSWERID` ASC)  COMMENT '',
  CONSTRAINT `FK_T16_M12QUESTIONID`
    FOREIGN KEY (`M12QUESTIONID`)
    REFERENCES `NUMERACY`.`M12_QUESTION` (`M12QUESTIONID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T16_M13ANSWERID`
    FOREIGN KEY (`M13ANSWERID`)
    REFERENCES `NUMERACY`.`M13_ANSWER` (`M13ANSWERID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T17_QUESTION_FILE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T17_QUESTION_FILE` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T17_QUESTION_FILE` (
  `T17QUESTIONFILEID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M12QUESTIONID` INT NULL COMMENT '',
  `M06FILEID` INT NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  `DISPLAYORDER` INT NULL COMMENT '',
  `ACTIVE` TINYINT(1) NULL DEFAULT 1 COMMENT '',
  PRIMARY KEY (`T17QUESTIONFILEID`)  COMMENT '',
  INDEX `FK_M12_M06FILEID_idx` (`M06FILEID` ASC)  COMMENT '',
  INDEX `FK_T17_M12QUESTIONID_idx` (`M12QUESTIONID` ASC)  COMMENT '',
  CONSTRAINT `FK_T17_M06FILEID`
    FOREIGN KEY (`M06FILEID`)
    REFERENCES `NUMERACY`.`M06_FILE` (`M06FILEID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T17_M12QUESTIONID`
    FOREIGN KEY (`M12QUESTIONID`)
    REFERENCES `NUMERACY`.`M12_QUESTION` (`M12QUESTIONID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T18_ANSWER_FILE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T18_ANSWER_FILE` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T18_ANSWER_FILE` (
  `T18ANSWERFILEID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M13ANSWERID` INT NULL COMMENT '',
  `M06FILEID` INT NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  `DISPLAYORDER` INT NULL COMMENT '',
  `ACTIVE` TINYINT(1) NULL DEFAULT 1 COMMENT '',
  `TEXTANSWER` VARCHAR(100) NULL COMMENT 'ANSWER IN TEXT FORMAT FOR VALIDATION',
  PRIMARY KEY (`T18ANSWERFILEID`)  COMMENT '',
  INDEX `FK_M12_M06FILEID_idx` (`M06FILEID` ASC)  COMMENT '',
  INDEX `FK_T18_M13ANSWERID_idx` (`M13ANSWERID` ASC)  COMMENT '',
  CONSTRAINT `FK_T18_M06FILEID`
    FOREIGN KEY (`M06FILEID`)
    REFERENCES `NUMERACY`.`M06_FILE` (`M06FILEID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T18_M13ANSWERID`
    FOREIGN KEY (`M13ANSWERID`)
    REFERENCES `NUMERACY`.`M13_ANSWER` (`M13ANSWERID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T19_LESSON_QUESTION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T19_LESSON_QUESTION` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T19_LESSON_QUESTION` (
  `T19LESSONQUESTIONID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `M05LESSONID` INT NULL COMMENT '',
  `M12QUESTIONID` INT NULL COMMENT '',
  `CREATEDON` DATETIME NULL COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`T19LESSONQUESTIONID`)  COMMENT '',
  INDEX `FK_T19_M05LESSONID_idx` (`M05LESSONID` ASC)  COMMENT '',
  INDEX `FK_T19_M12QUESTIONID_idx` (`M12QUESTIONID` ASC)  COMMENT '',
  CONSTRAINT `FK_T19_M05LESSONID`
    FOREIGN KEY (`M05LESSONID`)
    REFERENCES `NUMERACY`.`M05_LESSON` (`M05LESSONID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T19_M12QUESTIONID`
    FOREIGN KEY (`M12QUESTIONID`)
    REFERENCES `NUMERACY`.`M12_QUESTION` (`M12QUESTIONID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`T20_USER_LESSON_QUESTION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`T20_USER_LESSON_QUESTION` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`T20_USER_LESSON_QUESTION` (
  `T20USERLESSONQUESTIONID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `T07USERCATEGORYLEVELCHAPLESSID` INT NULL COMMENT '',
  `T19LESSONQUESTIONID` INT NULL COMMENT '',
  `STRATEDON` DATETIME NULL COMMENT '',
  `COMPLETEDON` DATETIME NULL COMMENT '',
  `SKIPPED` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `GIVENANSWER` VARCHAR(100) NULL COMMENT 'ANSWER GIVEN BY USER',
  `RESULT` TINYINT(1) NULL COMMENT 'ANSWERED CORRECTLY OR NOT',
  `ATTEMPT` INT NULL COMMENT 'NO OF ATTEMPTS',
  PRIMARY KEY (`T20USERLESSONQUESTIONID`)  COMMENT '',
  INDEX `FK_T20_T07USERCATEGORYLEVELCHAPLESSID_idx` (`T07USERCATEGORYLEVELCHAPLESSID` ASC)  COMMENT '',
  INDEX `FK_T20_T19LESSONQUESTIONID_idx` (`T19LESSONQUESTIONID` ASC)  COMMENT '',
  CONSTRAINT `FK_T20_T07USERCATEGORYLEVELCHAPLESSID`
    FOREIGN KEY (`T07USERCATEGORYLEVELCHAPLESSID`)
    REFERENCES `NUMERACY`.`T07_USER_CAT_LEV_CHAP_LESS` (`T07USERCATEGORYLEVELCHAPLESSID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_T20_T19LESSONQUESTIONID`
    FOREIGN KEY (`T19LESSONQUESTIONID`)
    REFERENCES `NUMERACY`.`T19_LESSON_QUESTION` (`T19LESSONQUESTIONID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `NUMERACY`.`M14_LOGIN`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `NUMERACY`.`M14_LOGIN` ;

CREATE TABLE IF NOT EXISTS `NUMERACY`.`M14_LOGIN` (
  `M14LOGINID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `USERNAME` VARCHAR(45) NOT NULL COMMENT '',
  `PASSWORD` VARCHAR(45) NULL COMMENT '',
  `CREATEDON` DATETIME NULL DEFAULT NOW() COMMENT '',
  `CREATEDBY` VARCHAR(45) NULL COMMENT '',
  `MODIFIEDON` DATETIME NULL COMMENT '',
  `MODIFIEDBY` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`M14LOGINID`)  COMMENT '',
  UNIQUE INDEX `username_UNIQUE` (`USERNAME` ASC)  COMMENT '',
  UNIQUE INDEX `M14LOGINID_UNIQUE` (`M14LOGINID` ASC)  COMMENT '')
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
