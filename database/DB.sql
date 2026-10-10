-- MySQL Workbench Forward Engineering
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS,UNIQUE_CHECKS=0;
SET
@OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS,FOREIGN_KEY_CHECKS
=0;
SET
@OLD_SQL_MODE=@@SQL_MODE,SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TR
ANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,
NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `Trabalho_Final`;
USE `Trabalho_Final`;

CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Usuario` (
`idUsuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`nome` VARCHAR(100) NOT NULL,
`email` VARCHAR(100) NOT NULL,
`senha` VARCHAR(6) NOT NULL,
PRIMARY KEY (`idUsuario`),
UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Filme` (
`idFilme` INT NOT NULL AUTO_INCREMENT,
`Titulo` VARCHAR(45) NOT NULL,

`sinopse` TEXT(500) NOT NULL,
`data_lancemento` DATE NOT NULL,
`nota` DECIMAL(5,1) NOT NULL,
`imagem` VARCHAR(500) NOT NULL,
`id_tmdb` INT NOT NULL,
PRIMARY KEY (`idFilme`),
UNIQUE INDEX `id_tmdb_UNIQUE` (`id_tmdb` ASC) VISIBLE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Genero` (
`idGenero` INT NOT NULL AUTO_INCREMENT,
`nome` VARCHAR(45) NOT NULL,
`descricao` TEXT(500) NULL,
PRIMARY KEY (`idGenero`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Favorito` (
`data_favorito` DATE NOT NULL,
`Usuario_idUsuario` INT UNSIGNED NOT NULL,
`Filme_idFilme` INT NOT NULL,
PRIMARY KEY (`Usuario_idUsuario`,`Filme_idFilme`),
INDEX `fk_Favorito_Filme1_idx` (`Filme_idFilme` ASC) VISIBLE,
CONSTRAINT `fk_Favorito_Usuario1`
FOREIGN KEY (`Usuario_idUsuario`)
REFERENCES `Trabalho_Final`.`Usuario` (`idUsuario`)
ON DELETE NO ACTION
ON UPDATE NO ACTION,
CONSTRAINT `fk_Favorito_Filme1`
FOREIGN KEY (`Filme_idFilme`)
REFERENCES `Trabalho_Final`.`Filme` (`idFilme`)
ON DELETE NO ACTION
ON UPDATE NO ACTION

) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Curtido` (
`data_curtida` DATE NOT NULL,
`Usuario_idUsuario` INT UNSIGNED NOT NULL,
`Filme_idFilme` INT NOT NULL,
PRIMARY KEY (`Usuario_idUsuario`,`Filme_idFilme`),
INDEX `fk_Curtido_Filme1_idx` (`Filme_idFilme` ASC) VISIBLE,
CONSTRAINT `fk_Curtido_Usuario1`
FOREIGN KEY (`Usuario_idUsuario`)
REFERENCES `Trabalho_Final`.`Usuario` (`idUsuario`)
ON DELETE NO ACTION
ON UPDATE NO ACTION,
CONSTRAINT `fk_Curtido_Filme1`
FOREIGN KEY (`Filme_idFilme`)
REFERENCES `Trabalho_Final`.`Filme` (`idFilme`)
ON DELETE NO ACTION
ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Avaliacao` (
`idAvaliacao` INT NOT NULL AUTO_INCREMENT,
`nota` DECIMAL(10,1) NOT NULL,
`comentario` TEXT(250) NULL,
`data_criacao` DATE NOT NULL,
`Usuario_idUsuario` INT UNSIGNED NOT NULL,
`Filme_idFilme` INT NOT NULL,
PRIMARY KEY (`idAvaliacao`),
INDEX `fk_Avaliacao_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
INDEX `fk_Avaliacao_Filme1_idx` (`Filme_idFilme` ASC) VISIBLE,
CONSTRAINT `fk_Avaliacao_Usuario1`
FOREIGN KEY (`Usuario_idUsuario`)

REFERENCES `Trabalho_Final`.`Usuario` (`idUsuario`)
ON DELETE NO ACTION
ON UPDATE NO ACTION,
CONSTRAINT `fk_Avaliacao_Filme1`
FOREIGN KEY (`Filme_idFilme`)
REFERENCES `Trabalho_Final`.`Filme` (`idFilme`)
ON DELETE NO ACTION
ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Genero_Filme` (
`Genero_idGenero` INT NOT NULL,
`Filme_idFilme` INT NOT NULL,
PRIMARY KEY (`Genero_idGenero`,`Filme_idFilme`),
INDEX `fk_Genero_has_Filme_Filme1_idx` (`Filme_idFilme` ASC) VISIBLE,
INDEX `fk_Genero_has_Filme_Genero_idx` (`Genero_idGenero` ASC) VISIBLE,
CONSTRAINT `fk_Genero_has_Filme_Genero`
FOREIGN KEY (`Genero_idGenero`)
REFERENCES `Trabalho_Final`.`Genero` (`idGenero`)
ON DELETE NO ACTION
ON UPDATE NO ACTION,
CONSTRAINT `fk_Genero_has_Filme_Filme1`
FOREIGN KEY (`Filme_idFilme`)
REFERENCES `Trabalho_Final`.`Filme` (`idFilme`)
ON DELETE NO ACTION
ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Trabalho_Final`.`Historico_pesquisa` (
`idHistorico_pesquisa` INT NOT NULL AUTO_INCREMENT,
`termo` VARCHAR(100) NOT NULL,
`data_pesquisa` DATE NOT NULL,

`Usuario_idUsuario` INT UNSIGNED NOT NULL,
PRIMARY KEY (`idHistorico_pesquisa`),
INDEX `fk_Historico_pesquisa_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
CONSTRAINT `fk_Historico_pesquisa_Usuario1`
FOREIGN KEY (`Usuario_idUsuario`)
REFERENCES `Trabalho_Final`.`Usuario` (`idUsuario`)
ON DELETE NO ACTION
ON UPDATE NO ACTION
) ENGINE=InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;