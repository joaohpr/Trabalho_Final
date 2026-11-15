-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Trabalho_Final
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Trabalho_Final
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Trabalho_Final` ;
USE `Trabalho_Final` ;

-- -----------------------------------------------------
-- Table `Trabalho_Final`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Trabalho_Final`.`Filme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Filme` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `sinopse` TEXT NOT NULL,
  `data_lancamento` DATE NOT NULL,
  `nota` DECIMAL(5,1) NULL,
  `imagem` VARCHAR(500) NOT NULL,
  `id_tmdb` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_tmdb_UNIQUE` (`id_tmdb` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Trabalho_Final`.`Genero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Genero` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Trabalho_Final`.`Genero_Filme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Genero_Filme` (
  `Genero_id` INT NOT NULL,
  `Filme_id` INT NOT NULL,
  PRIMARY KEY (`Genero_id`, `Filme_id`),
  INDEX `fk_Genero_has_Filme_Filme1_idx` (`Filme_id` ASC) VISIBLE,
  INDEX `fk_Genero_has_Filme_Genero_idx` (`Genero_id` ASC) VISIBLE,
  CONSTRAINT `fk_Genero_has_Filme_Genero`
    FOREIGN KEY (`Genero_id`)
    REFERENCES `Trabalho_Final`.`Genero` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Genero_has_Filme_Filme1`
    FOREIGN KEY (`Filme_id`)
    REFERENCES `Trabalho_Final`.`Filme` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Trabalho_Final`.`Historico_pesquisa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Historico_pesquisa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `termo` VARCHAR(100) NOT NULL,
  `data_pesquisa` DATE NOT NULL,
  `Filme_id` INT NOT NULL,
  `Usuario_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Filme_id`, `Usuario_id`),
  INDEX `fk_Historico_pesquisa_Filme1_idx` (`Filme_id` ASC) VISIBLE,
  INDEX `fk_Historico_pesquisa_Usuario1_idx` (`Usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_Historico_pesquisa_Filme1`
    FOREIGN KEY (`Filme_id`)
    REFERENCES `Trabalho_Final`.`Filme` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Historico_pesquisa_Usuario1`
    FOREIGN KEY (`Usuario_id`)
    REFERENCES `Trabalho_Final`.`Usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Trabalho_Final`.`Avaliacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Avaliacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comentario` TEXT NOT NULL,
  `data_criacao` DATE NOT NULL,
  `nota` DECIMAL(5,1) NULL,
  `Usuario_id` INT NOT NULL,
  `Filme_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Usuario_id`, `Filme_id`),
  INDEX `fk_Avaliacao_Usuario1_idx` (`Usuario_id` ASC) VISIBLE,
  INDEX `fk_Avaliacao_Filme1_idx` (`Filme_id` ASC) VISIBLE,
  CONSTRAINT `fk_Avaliacao_Usuario1`
    FOREIGN KEY (`Usuario_id`)
    REFERENCES `Trabalho_Final`.`Usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Avaliacao_Filme1`
    FOREIGN KEY (`Filme_id`)
    REFERENCES `Trabalho_Final`.`Filme` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Trabalho_Final`.`Curtido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Curtido` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data_curtida` DATETIME NOT NULL,
  `Filme_id` INT NOT NULL,
  `Usuario_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Filme_id`, `Usuario_id`),
  INDEX `fk_Curtido_Filme1_idx` (`Filme_id` ASC) VISIBLE,
  INDEX `fk_Curtido_Usuario1_idx` (`Usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_Curtido_Filme1`
    FOREIGN KEY (`Filme_id`)
    REFERENCES `Trabalho_Final`.`Filme` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Curtido_Usuario1`
    FOREIGN KEY (`Usuario_id`)
    REFERENCES `Trabalho_Final`.`Usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Trabalho_Final`.`Curtida_Avalicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Curtida_Avalicao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data_curtida` VARCHAR(45) NOT NULL,
  `Avaliacao_id` INT NOT NULL,
  `Avaliacao_Usuario_id` INT NOT NULL,
  `Avaliacao_Filme_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Avaliacao_id`, `Avaliacao_Usuario_id`, `Avaliacao_Filme_id`),
  INDEX `fk_Curtida_Avalicao_Avaliacao1_idx` (`Avaliacao_id` ASC, `Avaliacao_Usuario_id` ASC, `Avaliacao_Filme_id` ASC) VISIBLE,
  CONSTRAINT `fk_Curtida_Avalicao_Avaliacao1`
    FOREIGN KEY (`Avaliacao_id` , `Avaliacao_Usuario_id` , `Avaliacao_Filme_id`)
    REFERENCES `Trabalho_Final`.`Avaliacao` (`id` , `Usuario_id` , `Filme_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
