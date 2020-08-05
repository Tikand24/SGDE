-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema sgde2
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sgde2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sgde2` DEFAULT CHARACTER SET utf8 ;
USE `sgde2` ;

-- -----------------------------------------------------
-- Table `sgde2`.`estados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`estados` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`users` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_estados1_idx` (`estados_id` ASC) ,
  CONSTRAINT `fk_users_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`cargos_celebrante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`cargos_celebrante` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cargo` VARCHAR(45) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cargo_celebs_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_cargo_celebs_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_cargo_celebs_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cargo_celebs_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`celebrantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`celebrantes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom_celebrante` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `users_id` INT(10) NOT NULL,
  `estados_id` INT NOT NULL,
  `cargos_celebrante_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_celebrantes_users1_idx` (`users_id` ASC) ,
  INDEX `fk_celebrantes_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_celebrantes_cargos_celebrante1_idx` (`cargos_celebrante_id` ASC) ,
  CONSTRAINT `fk_celebrantes_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_celebrantes_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_celebrantes_cargos_celebrante1`
    FOREIGN KEY (`cargos_celebrante_id`)
    REFERENCES `sgde2`.`cargos_celebrante` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`cargo_parroquial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`cargo_parroquial` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `users_id` INT(10) NOT NULL,
  `estados_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cargo_parroquial_users1_idx` (`users_id` ASC) ,
  INDEX `fk_cargo_parroquial_estados1_idx` (`estados_id` ASC) ,
  CONSTRAINT `fk_cargo_parroquial_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cargo_parroquial_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`celebrantes_parroquias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`celebrantes_parroquias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `celebrantes_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `cargo_parroquial_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `celebrantes_id` (`celebrantes_id` ASC) ,
  INDEX `fk_celeb_parroquias_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_celebrantes_parroquias_cargo_parroquial1_idx` (`cargo_parroquial_id` ASC) ,
  CONSTRAINT `celebrantes_id_parroquia`
    FOREIGN KEY (`celebrantes_id`)
    REFERENCES `sgde2`.`celebrantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_celeb_parroquias_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_celebrantes_parroquias_cargo_parroquial1`
    FOREIGN KEY (`cargo_parroquial_id`)
    REFERENCES `sgde2`.`cargo_parroquial` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`grupos_confirmaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`grupos_confirmaciones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `fecha` DATE NULL DEFAULT NULL,
  `descripcion` TEXT NULL DEFAULT NULL,
  `descripcion_partida` MEDIUMTEXT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  `celebrantes_parroquias_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_grupos_confirmaciones_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_grupos_confirmaciones_users1_idx` (`users_id` ASC) ,
  INDEX `fk_grupos_confirmaciones_celebrantes_parroquias1_idx` (`celebrantes_parroquias_id` ASC) ,
  CONSTRAINT `fk_grupos_confirmaciones_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupos_confirmaciones_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupos_confirmaciones_celebrantes_parroquias1`
    FOREIGN KEY (`celebrantes_parroquias_id`)
    REFERENCES `sgde2`.`celebrantes_parroquias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`departamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`departamentos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cod_departamento` INT(11) NOT NULL,
  `nom_departamento` VARCHAR(45) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `users_id` INT(10) NOT NULL,
  `estados_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_departamentos_users1_idx` (`users_id` ASC) ,
  INDEX `fk_departamentos_estados1_idx` (`estados_id` ASC) ,
  CONSTRAINT `fk_departamentos_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_departamentos_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 33
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`municipios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`municipios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cod_municipio` INT(11) NOT NULL,
  `nom_municipio` VARCHAR(45) NULL DEFAULT NULL,
  `departamentos_id` INT(11) NOT NULL,
  `created_at` VARCHAR(45) NULL,
  `updated_at` VARCHAR(45) NULL,
  `users_id` INT(10) NOT NULL,
  `estados_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_municipios_departamentos1_idx` (`departamentos_id` ASC) ,
  INDEX `fk_municipios_users1_idx` (`users_id` ASC) ,
  INDEX `fk_municipios_estados1_idx` (`estados_id` ASC) ,
  CONSTRAINT `fk_municipios_departamentos1`
    FOREIGN KEY (`departamentos_id`)
    REFERENCES `sgde2`.`departamentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_municipios_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_municipios_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1103
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`parroquias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`parroquias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(500) NULL DEFAULT NULL,
  `dio_arq_diocesis` VARCHAR(500) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `municipios_id` INT(11) NOT NULL,
  `users_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_parroquias_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_parroquias_municipios1_idx` (`municipios_id` ASC) ,
  INDEX `fk_parroquias_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_parroquias_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_parroquias_municipios1`
    FOREIGN KEY (`municipios_id`)
    REFERENCES `sgde2`.`municipios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_parroquias_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`genero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`genero` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_genero_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_genero_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_genero_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_genero_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`confirmaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`confirmaciones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL DEFAULT NULL,
  `libro` INT(11) NULL DEFAULT NULL,
  `folio` INT(11) NULL DEFAULT NULL,
  `partida` INT(11) NULL DEFAULT NULL,
  `madre` VARCHAR(45) NULL DEFAULT NULL,
  `padre` VARCHAR(45) NULL DEFAULT NULL,
  `madrina` VARCHAR(45) NULL DEFAULT NULL,
  `padrino` VARCHAR(45) NULL DEFAULT NULL,
  `lib_baut` VARCHAR(45) NULL DEFAULT NULL,
  `fol_baut` VARCHAR(45) NULL DEFAULT NULL,
  `part_baut` VARCHAR(45) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `grupos_confirmaciones_id` INT(11) NOT NULL,
  `users_id` INT(10) NOT NULL,
  `parroquias_id` INT(11) NOT NULL,
  `genero_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_confirmaciones_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_confirmaciones_grupos_confirmaciones1_idx` (`grupos_confirmaciones_id` ASC) ,
  INDEX `fk_confirmaciones_users1_idx` (`users_id` ASC) ,
  INDEX `fk_confirmaciones_parroquias1_idx` (`parroquias_id` ASC) ,
  INDEX `fk_confirmaciones_genero1_idx` (`genero_id` ASC) ,
  CONSTRAINT `fk_confirmaciones_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_confirmaciones_grupos_confirmaciones1`
    FOREIGN KEY (`grupos_confirmaciones_id`)
    REFERENCES `sgde2`.`grupos_confirmaciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_confirmaciones_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_confirmaciones_parroquias1`
    FOREIGN KEY (`parroquias_id`)
    REFERENCES `sgde2`.`parroquias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_confirmaciones_genero1`
    FOREIGN KEY (`genero_id`)
    REFERENCES `sgde2`.`genero` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5920
DEFAULT CHARACTER SET = utf8
COMMENT = '	';


-- -----------------------------------------------------
-- Table `sgde2`.`anotacion_confirmaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`anotacion_confirmaciones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `anotacion` TEXT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  `confirmaciones_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_anotacion_confirmaciones_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_anotacion_confirmaciones_users1_idx` (`users_id` ASC) ,
  INDEX `fk_anotacion_confirmaciones_confirmaciones1_idx` (`confirmaciones_id` ASC) ,
  CONSTRAINT `fk_anotacion_confirmaciones_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotacion_confirmaciones_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotacion_confirmaciones_confirmaciones1`
    FOREIGN KEY (`confirmaciones_id`)
    REFERENCES `sgde2`.`confirmaciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`matrimonios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`matrimonios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombres` MEDIUMTEXT NULL DEFAULT NULL,
  `libro` INT(11) NULL DEFAULT NULL,
  `folio` INT(11) NULL DEFAULT NULL,
  `partida` INT(11) NULL DEFAULT NULL,
  `fecha_matrimonio` DATE NULL DEFAULT NULL,
  `esposo` VARCHAR(200) NULL DEFAULT NULL,
  `esposa` VARCHAR(200) NULL DEFAULT NULL,
  `padre_esposo` VARCHAR(200) NULL DEFAULT NULL,
  `madre_esposo` VARCHAR(200) NULL DEFAULT NULL,
  `padre_esposa` VARCHAR(200) NULL DEFAULT NULL,
  `madre_esposa` VARCHAR(200) NULL DEFAULT NULL,
  `fecha_bautizo_esposo` DATE NULL DEFAULT NULL,
  `esposo_libro_bautizado` VARCHAR(45) NULL DEFAULT NULL,
  `esposo_folio_bautizado` VARCHAR(45) NULL DEFAULT NULL,
  `esposo_partida_bautizado` VARCHAR(45) NULL DEFAULT NULL,
  `fecha_bautizo_esposa` DATE NULL DEFAULT NULL,
  `esposa_libro_bautizada` VARCHAR(45) NULL DEFAULT NULL,
  `esposa_folio_bautizada` VARCHAR(45) NULL DEFAULT NULL,
  `esposa_partida_bautizada` VARCHAR(45) NULL DEFAULT NULL,
  `fecha_confirmado_esposo` DATE NULL DEFAULT NULL,
  `esposo_libro_confirmacion` VARCHAR(45) NULL DEFAULT NULL,
  `esposo_folio_confirmacion` VARCHAR(45) NULL DEFAULT NULL,
  `esposo_partida_confirmacion` VARCHAR(45) NULL DEFAULT NULL,
  `fecha_confirmado_esposa` DATE NULL DEFAULT NULL,
  `esposa_libro_confirmada` VARCHAR(45) NULL DEFAULT NULL,
  `esposa_folio_confirmada` VARCHAR(45) NULL DEFAULT NULL,
  `esposa_partida_confirmada` VARCHAR(45) NULL DEFAULT NULL,
  `padrino` VARCHAR(200) NULL DEFAULT NULL,
  `madrina` VARCHAR(200) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  `celebrantes_parroquias_id_parrocco` INT(11) NOT NULL,
  `celebrantes_parroquias_id_celebrante` INT(11) NOT NULL,
  `parroquias_id_bautizado` INT(11) NOT NULL,
  `parroquias_id_bautizada` INT(11) NOT NULL,
  `parroquias_id_confirmado` INT(11) NOT NULL,
  `parroquias_id_confirmada` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_matrimonios_estados1_idx` (`estados_id` ASC),
  INDEX `fk_matrimonios_users1_idx` (`users_id` ASC) ,
  INDEX `fk_matrimonios_celebrantes_parroquias1_idx` (`celebrantes_parroquias_id_parrocco` ASC) ,
  INDEX `fk_matrimonios_celebrantes_parroquias2_idx` (`celebrantes_parroquias_id_celebrante` ASC) ,
  INDEX `fk_matrimonios_parroquias1_idx` (`parroquias_id_bautizado` ASC) ,
  INDEX `fk_matrimonios_parroquias2_idx` (`parroquias_id_bautizada` ASC) ,
  INDEX `fk_matrimonios_parroquias3_idx` (`parroquias_id_confirmado` ASC) ,
  INDEX `fk_matrimonios_parroquias4_idx` (`parroquias_id_confirmada` ASC) ,
  CONSTRAINT `fk_matrimonios_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matrimonios_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matrimonios_celebrantes_parroquias1`
    FOREIGN KEY (`celebrantes_parroquias_id_parrocco`)
    REFERENCES `sgde2`.`celebrantes_parroquias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matrimonios_celebrantes_parroquias2`
    FOREIGN KEY (`celebrantes_parroquias_id_celebrante`)
    REFERENCES `sgde2`.`celebrantes_parroquias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matrimonios_parroquias1`
    FOREIGN KEY (`parroquias_id_bautizado`)
    REFERENCES `sgde2`.`parroquias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matrimonios_parroquias2`
    FOREIGN KEY (`parroquias_id_bautizada`)
    REFERENCES `sgde2`.`parroquias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matrimonios_parroquias3`
    FOREIGN KEY (`parroquias_id_confirmado`)
    REFERENCES `sgde2`.`parroquias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_matrimonios_parroquias4`
    FOREIGN KEY (`parroquias_id_confirmada`)
    REFERENCES `sgde2`.`parroquias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2313
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`anotacion_matrimonios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`anotacion_matrimonios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `anotacion` MEDIUMTEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NOT NULL,
  `users_id` INT(10) NOT NULL,
  `estados_id` INT NOT NULL,
  `matrimonios_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_anotacion_matrimonios_users1_idx` (`users_id` ASC) ,
  INDEX `fk_anotacion_matrimonios_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_anotacion_matrimonios_matrimonios1_idx` (`matrimonios_id` ASC) ,
  CONSTRAINT `fk_anotacion_matrimonios_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotacion_matrimonios_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotacion_matrimonios_matrimonios1`
    FOREIGN KEY (`matrimonios_id`)
    REFERENCES `sgde2`.`matrimonios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`bautisados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`bautisados` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL DEFAULT NULL,
  `libro` INT(11) NULL DEFAULT NULL,
  `folio` INT(11) NULL DEFAULT NULL,
  `partida` INT(11) NULL DEFAULT NULL,
  `nom_padre` VARCHAR(45) NULL DEFAULT NULL,
  `nom_madre` VARCHAR(45) NULL DEFAULT NULL,
  `abuelo_paterno` VARCHAR(45) NULL DEFAULT NULL,
  `abuela_paterna` VARCHAR(45) NULL DEFAULT NULL,
  `abuelo_materno` VARCHAR(45) NULL DEFAULT NULL,
  `abuela_materna` VARCHAR(45) NULL DEFAULT NULL,
  `nom_padrino` VARCHAR(45) NULL DEFAULT NULL,
  `nom_madrina` VARCHAR(45) NULL DEFAULT NULL,
  `fecha_nacimiento` DATE NULL DEFAULT NULL,
  `fecha_bautismo` DATE NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  `municipios_id` INT(11) NOT NULL,
  `celebrantes_parroquias_id_celebrante` INT(11) NOT NULL,
  `celebrantes_parroquias_id_parroco` INT(11) NOT NULL,
  `genero_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_bautisados_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_bautisados_users1_idx` (`users_id` ASC) ,
  INDEX `fk_bautisados_municipios1_idx` (`municipios_id` ASC) ,
  INDEX `fk_bautisados_celebrantes_parroquias1_idx` (`celebrantes_parroquias_id_celebrante` ASC) ,
  INDEX `fk_bautisados_celebrantes_parroquias2_idx` (`celebrantes_parroquias_id_parroco` ASC) ,
  INDEX `fk_bautisados_genero1_idx` (`genero_id` ASC) ,
  CONSTRAINT `fk_bautisados_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bautisados_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bautisados_municipios1`
    FOREIGN KEY (`municipios_id`)
    REFERENCES `sgde2`.`municipios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bautisados_celebrantes_parroquias1`
    FOREIGN KEY (`celebrantes_parroquias_id_celebrante`)
    REFERENCES `sgde2`.`celebrantes_parroquias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bautisados_celebrantes_parroquias2`
    FOREIGN KEY (`celebrantes_parroquias_id_parroco`)
    REFERENCES `sgde2`.`celebrantes_parroquias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bautisados_genero1`
    FOREIGN KEY (`genero_id`)
    REFERENCES `sgde2`.`genero` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 20469
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`anotacion_bautismos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`anotacion_bautismos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `anotacion` VARCHAR(500) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  `bautisados_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_anotaciones_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_anotacion_bautismos_users1_idx` (`users_id` ASC) ,
  INDEX `fk_anotacion_bautismos_bautisados1_idx` (`bautisados_id` ASC) ,
  CONSTRAINT `fk_anotaciones_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotacion_bautismos_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotacion_bautismos_bautisados1`
    FOREIGN KEY (`bautisados_id`)
    REFERENCES `sgde2`.`bautisados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`cambios_sistemas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`cambios_sistemas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cambio_id` VARCHAR(45) NOT NULL,
  `tipo_cambio` VARCHAR(45) NOT NULL,
  `descipcion_cambio` MEDIUMTEXT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `users_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `bautizado_id` (`cambio_id` ASC) ,
  INDEX `fk_cambios_sistemas_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_cambios_sistemas_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`tipos_documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`tipos_documento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `prefijo` VARCHAR(45) NULL,
  `nombre` VARCHAR(45) NULL,
  `longitud` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tipos_documento_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_tipos_documento_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_tipos_documento_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipos_documento_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`cenizarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`cenizarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `numero` INT(11) NOT NULL,
  `comprador` VARCHAR(200) NOT NULL,
  `fallecido` VARCHAR(200) NOT NULL,
  `identificacion_titular` VARCHAR(200) NULL DEFAULT NULL,
  `fecha_nacimiento` DATE NULL DEFAULT NULL,
  `fecha_fallecimiento` DATE NULL DEFAULT NULL,
  `fecha_traslado` DATE NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `municipios_id` INT(11) NOT NULL,
  `users_id` INT(10) NOT NULL,
  `estados_id` INT NOT NULL,
  `tipos_documento_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cenizarios_municipios1_idx` (`municipios_id` ASC) ,
  INDEX `fk_cenizarios_users1_idx` (`users_id` ASC) ,
  INDEX `fk_cenizarios_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_cenizarios_tipos_documento1_idx` (`tipos_documento_id` ASC) ,
  CONSTRAINT `fk_cenizarios_municipios1`
    FOREIGN KEY (`municipios_id`)
    REFERENCES `sgde2`.`municipios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cenizarios_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cenizarios_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cenizarios_tipos_documento1`
    FOREIGN KEY (`tipos_documento_id`)
    REFERENCES `sgde2`.`tipos_documento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 236
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`dias_eucaristias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`dias_eucaristias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `dia_semana` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`grupos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`grupos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_grupos_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_grupos_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_grupos_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupos_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`eventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`eventos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` MEDIUMTEXT NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `users_id` INT(10) NOT NULL,
  `grupos_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_eventos_users1_idx` (`users_id` ASC) ,
  INDEX `fk_eventos_grupos1_idx` (`grupos_id` ASC) ,
  CONSTRAINT `fk_eventos_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_grupos1`
    FOREIGN KEY (`grupos_id`)
    REFERENCES `sgde2`.`grupos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`fechas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`fechas` (
  `fec` DATE NULL DEFAULT NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`feligres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`feligres` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `apellido` VARCHAR(50) NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `email` VARCHAR(100) NULL DEFAULT NULL,
  `telefono` VARCHAR(30) NULL DEFAULT NULL,
  `recibir_notificacion` INT(1) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_feligres_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_feligres_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_feligres_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_feligres_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`lugar_eucaristias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`lugar_eucaristias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_lugar_eucaristias_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_lugar_eucaristias_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_lugar_eucaristias_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lugar_eucaristias_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`horario_eucaristias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`horario_eucaristias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `dia_eucaristia_id` INT(11) NOT NULL,
  `hora_eucaristia` TIME NOT NULL,
  `lugar_eucaristia` INT(11) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `dia_eucaristia_id` (`dia_eucaristia_id` ASC) ,
  INDEX `lugar_eucaristia` (`lugar_eucaristia` ASC) ,
  CONSTRAINT `dias_eucaristias`
    FOREIGN KEY (`dia_eucaristia_id`)
    REFERENCES `sgde2`.`dias_eucaristias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `lugar_eucaristia`
    FOREIGN KEY (`lugar_eucaristia`)
    REFERENCES `sgde2`.`lugar_eucaristias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 28
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`integrantes_grupo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`integrantes_grupo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `feligres_id` INT(11) NOT NULL,
  `grupos_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_integrantes_grupo_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_integrantes_grupo_feligres1_idx` (`feligres_id` ASC) ,
  INDEX `fk_integrantes_grupo_grupos1_idx` (`grupos_id` ASC) ,
  CONSTRAINT `fk_integrantes_grupo_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_integrantes_grupo_feligres1`
    FOREIGN KEY (`feligres_id`)
    REFERENCES `sgde2`.`feligres` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_integrantes_grupo_grupos1`
    FOREIGN KEY (`grupos_id`)
    REFERENCES `sgde2`.`grupos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`mensajes_sacerdotes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`mensajes_sacerdotes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_feligres` VARCHAR(200) NOT NULL,
  `mensaje` LONGTEXT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  `celebrantes_parroquias_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_mensajes_sacerdotes_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_mensajes_sacerdotes_users1_idx` (`users_id` ASC) ,
  INDEX `fk_mensajes_sacerdotes_celebrantes_parroquias1_idx` (`celebrantes_parroquias_id` ASC) ,
  CONSTRAINT `fk_mensajes_sacerdotes_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensajes_sacerdotes_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensajes_sacerdotes_celebrantes_parroquias1`
    FOREIGN KEY (`celebrantes_parroquias_id`)
    REFERENCES `sgde2`.`celebrantes_parroquias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`osarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`osarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `numero` INT(11) NOT NULL,
  `comprador` VARCHAR(200) NULL DEFAULT NULL,
  `fallecido` VARCHAR(200) NULL DEFAULT NULL,
  `identificacion_titular` VARCHAR(45) NULL DEFAULT NULL,
  `fecha_nacimiento` DATE NULL DEFAULT NULL,
  `fecha_fallecimiento` DATE NULL DEFAULT NULL,
  `fecha_traslado` DATE NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `municipios_id` INT(11) NOT NULL,
  `users_id` INT(10) NOT NULL,
  `estados_id` INT NOT NULL,
  `tipos_documento_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_osarios_municipios1_idx` (`municipios_id` ASC) ,
  INDEX `fk_osarios_users1_idx` (`users_id` ASC) ,
  INDEX `fk_osarios_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_osarios_tipos_documento1_idx` (`tipos_documento_id` ASC) ,
  CONSTRAINT `fk_osarios_municipios1`
    FOREIGN KEY (`municipios_id`)
    REFERENCES `sgde2`.`municipios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_osarios_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_osarios_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_osarios_tipos_documento1`
    FOREIGN KEY (`tipos_documento_id`)
    REFERENCES `sgde2`.`tipos_documento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2104
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sgde2`.`integrante_grupo_pastoral`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`integrante_grupo_pastoral` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` MEDIUMTEXT NULL,
  `telefono` MEDIUMTEXT NULL,
  `email` MEDIUMTEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_integrante_grupo_pastoral_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_integrante_grupo_pastoral_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_integrante_grupo_pastoral_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_integrante_grupo_pastoral_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`tipos_grupo_pastoral`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`tipos_grupo_pastoral` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `estados_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tipos_grupo_pastoral_estados1_idx` (`estados_id` ASC) ,
  CONSTRAINT `fk_tipos_grupo_pastoral_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`tipos_integrantes_grupo_pastora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`tipos_integrantes_grupo_pastora` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL,
  `integrante_grupo_pastoral_id` INT NOT NULL,
  `tipos_grupo_pastoral_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  `estados_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tipos_integrantes_grupo_pastora_integrante_grupo_pastora_idx` (`integrante_grupo_pastoral_id` ASC) ,
  INDEX `fk_tipos_integrantes_grupo_pastora_tipos_grupo_pastoral1_idx` (`tipos_grupo_pastoral_id` ASC) ,
  INDEX `fk_tipos_integrantes_grupo_pastora_users1_idx` (`users_id` ASC) ,
  INDEX `fk_tipos_integrantes_grupo_pastora_estados1_idx` (`estados_id` ASC) ,
  CONSTRAINT `fk_tipos_integrantes_grupo_pastora_integrante_grupo_pastoral1`
    FOREIGN KEY (`integrante_grupo_pastoral_id`)
    REFERENCES `sgde2`.`integrante_grupo_pastoral` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipos_integrantes_grupo_pastora_tipos_grupo_pastoral1`
    FOREIGN KEY (`tipos_grupo_pastoral_id`)
    REFERENCES `sgde2`.`tipos_grupo_pastoral` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipos_integrantes_grupo_pastora_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipos_integrantes_grupo_pastora_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`asignacion_grupos_pastorales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`asignacion_grupos_pastorales` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `users_id` INT(10) NOT NULL,
  `tipos_integrantes_grupo_pastora_id` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `estados_id` INT NOT NULL,
  `fecha_inicio_vigencia` DATE NULL,
  `fecha_fin_vigencia` DATE NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_asignacion_grupos_pastorales_users1_idx` (`users_id` ASC) ,
  INDEX `fk_asignacion_grupos_pastorales_tipos_integrantes_grupo_pas_idx` (`tipos_integrantes_grupo_pastora_id` ASC) ,
  INDEX `fk_asignacion_grupos_pastorales_estados1_idx` (`estados_id` ASC) ,
  CONSTRAINT `fk_asignacion_grupos_pastorales_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignacion_grupos_pastorales_tipos_integrantes_grupo_pasto1`
    FOREIGN KEY (`tipos_integrantes_grupo_pastora_id`)
    REFERENCES `sgde2`.`tipos_integrantes_grupo_pastora` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignacion_grupos_pastorales_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`configuracion_celebraciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`configuracion_celebraciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `asignacion_grupos_pastorales_id_acolitos` INT NOT NULL,
  `asignacion_grupos_pastorales_id_ministros` INT NOT NULL,
  `asignacion_grupos_pastorales_id_cantantes` INT NOT NULL,
  `asignacion_grupos_pastorales_id_procalmadores` INT NOT NULL,
  `asignacion_grupos_pastorales_id_colectores` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  `estados_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_configuracion_celebraciones_asignacion_grupos_pastorales_idx` (`asignacion_grupos_pastorales_id_acolitos` ASC) ,
  INDEX `fk_configuracion_celebraciones_asignacion_grupos_pastorales_idx1` (`asignacion_grupos_pastorales_id_ministros` ASC) ,
  INDEX `fk_configuracion_celebraciones_asignacion_grupos_pastorales_idx2` (`asignacion_grupos_pastorales_id_cantantes` ASC) ,
  INDEX `fk_configuracion_celebraciones_asignacion_grupos_pastorales_idx3` (`asignacion_grupos_pastorales_id_procalmadores` ASC) ,
  INDEX `fk_configuracion_celebraciones_asignacion_grupos_pastorales_idx4` (`asignacion_grupos_pastorales_id_colectores` ASC) ,
  INDEX `fk_configuracion_celebraciones_users1_idx` (`users_id` ASC) ,
  INDEX `fk_configuracion_celebraciones_estados1_idx` (`estados_id` ASC) ,
  CONSTRAINT `fk_configuracion_celebraciones_asignacion_grupos_pastorales1`
    FOREIGN KEY (`asignacion_grupos_pastorales_id_acolitos`)
    REFERENCES `sgde2`.`asignacion_grupos_pastorales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_configuracion_celebraciones_asignacion_grupos_pastorales2`
    FOREIGN KEY (`asignacion_grupos_pastorales_id_ministros`)
    REFERENCES `sgde2`.`asignacion_grupos_pastorales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_configuracion_celebraciones_asignacion_grupos_pastorales3`
    FOREIGN KEY (`asignacion_grupos_pastorales_id_cantantes`)
    REFERENCES `sgde2`.`asignacion_grupos_pastorales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_configuracion_celebraciones_asignacion_grupos_pastorales4`
    FOREIGN KEY (`asignacion_grupos_pastorales_id_procalmadores`)
    REFERENCES `sgde2`.`asignacion_grupos_pastorales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_configuracion_celebraciones_asignacion_grupos_pastorales5`
    FOREIGN KEY (`asignacion_grupos_pastorales_id_colectores`)
    REFERENCES `sgde2`.`asignacion_grupos_pastorales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_configuracion_celebraciones_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_configuracion_celebraciones_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`celebraciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`celebraciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL,
  `hora` TIME NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `configuracion_celebraciones_id` INT NOT NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  `lugar_eucaristias_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_celebraciones_configuracion_celebraciones1_idx` (`configuracion_celebraciones_id` ASC) ,
  INDEX `fk_celebraciones_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_celebraciones_users1_idx` (`users_id` ASC) ,
  INDEX `fk_celebraciones_lugar_eucaristias1_idx` (`lugar_eucaristias_id` ASC) ,
  CONSTRAINT `fk_celebraciones_configuracion_celebraciones1`
    FOREIGN KEY (`configuracion_celebraciones_id`)
    REFERENCES `sgde2`.`configuracion_celebraciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_celebraciones_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_celebraciones_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_celebraciones_lugar_eucaristias1`
    FOREIGN KEY (`lugar_eucaristias_id`)
    REFERENCES `sgde2`.`lugar_eucaristias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`celebrantes_celebraciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`celebrantes_celebraciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `celebraciones_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `estados_id` INT NOT NULL,
  `celebrantes_parroquias_id` INT(11) NOT NULL,
  `users_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `celebraciones_celebrantes_celebraciones_fk_idx` (`celebraciones_id` ASC) ,
  INDEX `fk_celebrantes_celebraciones_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_celebrantes_celebraciones_celebrantes_parroquias1_idx` (`celebrantes_parroquias_id` ASC) ,
  INDEX `fk_celebrantes_celebraciones_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `celebraciones_celebrantes_celebraciones_fk`
    FOREIGN KEY (`celebraciones_id`)
    REFERENCES `sgde2`.`celebraciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_celebrantes_celebraciones_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_celebrantes_celebraciones_celebrantes_parroquias1`
    FOREIGN KEY (`celebrantes_parroquias_id`)
    REFERENCES `sgde2`.`celebrantes_parroquias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_celebrantes_celebraciones_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`comentarios_celebraciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`comentarios_celebraciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comentario` MEDIUMTEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `estados_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  `celebraciones_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comentarios_celebraciones_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_comentarios_celebraciones_users1_idx` (`users_id` ASC) ,
  INDEX `fk_comentarios_celebraciones_celebraciones1_idx` (`celebraciones_id` ASC) ,
  CONSTRAINT `fk_comentarios_celebraciones_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentarios_celebraciones_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentarios_celebraciones_celebraciones1`
    FOREIGN KEY (`celebraciones_id`)
    REFERENCES `sgde2`.`celebraciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`tipo_intenciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`tipo_intenciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` TINYTEXT NULL,
  `icono` TINYTEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `users_id` INT(10) NOT NULL,
  `estados_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tipo_intenciones_users1_idx` (`users_id` ASC) ,
  INDEX `fk_tipo_intenciones_estados1_idx` (`estados_id` ASC) ,
  CONSTRAINT `fk_tipo_intenciones_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_intenciones_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`intenciones_celebraciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`intenciones_celebraciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `intencion` TINYTEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `estados_id` INT NOT NULL,
  `tipo_intenciones_id` INT NOT NULL,
  `celebraciones_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_intenciones_celebraciones_estados1_idx` (`estados_id` ASC) ,
  INDEX `fk_intenciones_celebraciones_tipo_intenciones1_idx` (`tipo_intenciones_id` ASC) ,
  INDEX `fk_intenciones_celebraciones_celebraciones1_idx` (`celebraciones_id` ASC) ,
  INDEX `fk_intenciones_celebraciones_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_intenciones_celebraciones_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_intenciones_celebraciones_tipo_intenciones1`
    FOREIGN KEY (`tipo_intenciones_id`)
    REFERENCES `sgde2`.`tipo_intenciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_intenciones_celebraciones_celebraciones1`
    FOREIGN KEY (`celebraciones_id`)
    REFERENCES `sgde2`.`celebraciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_intenciones_celebraciones_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sgde2`.`grupos_pastorales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgde2`.`grupos_pastorales` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` TINYTEXT NULL,
  `telefono` TINYTEXT NULL,
  `descripcion_reunion` TINYTEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `integrante_grupo_pastoral_id` INT NOT NULL,
  `users_id` INT(10) NOT NULL,
  `estados_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_grupos_pastorales_integrante_grupo_pastoral1_idx` (`integrante_grupo_pastoral_id` ASC) ,
  INDEX `fk_grupos_pastorales_users1_idx` (`users_id` ASC) ,
  INDEX `fk_grupos_pastorales_estados1_idx` (`estados_id` ASC) ,
  CONSTRAINT `fk_grupos_pastorales_integrante_grupo_pastoral1`
    FOREIGN KEY (`integrante_grupo_pastoral_id`)
    REFERENCES `sgde2`.`integrante_grupo_pastoral` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupos_pastorales_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `sgde2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupos_pastorales_estados1`
    FOREIGN KEY (`estados_id`)
    REFERENCES `sgde2`.`estados` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
