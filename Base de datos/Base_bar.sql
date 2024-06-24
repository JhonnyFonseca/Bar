-- MySQL Script generated by MySQL Workbench
-- Fri May 24 15:33:54 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Base_bar
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Base_bar
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Base_bar` DEFAULT CHARACTER SET utf8 ;
USE `Base_bar` ;

-- -----------------------------------------------------
-- Table `Base_bar`.`Sedes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_bar`.`Sedes` (
  `idSedes` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Direccion` VARCHAR(100) NOT NULL,
  `Ciudad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idSedes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Base_bar`.`Rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_bar`.`Rol` (
  `idRol` INT NOT NULL,
  `Rol` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idRol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Base_bar`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_bar`.`Usuarios` (
  `idUsuarios` BIGINT(100) NOT NULL,
  `Nombre` VARCHAR(50) NOT NULL,
  `Apellido` VARCHAR(50) NOT NULL,
  `Celular` BIGINT(15) NOT NULL,
  `Usuario_Sede` INT NULL,
  `Rol` INT NULL,
  PRIMARY KEY (`idUsuarios`),
  CONSTRAINT `fk_Usuarios_Sedes1`
    FOREIGN KEY (`Usuario_Sede`)
    REFERENCES `Base_bar`.`Sedes` (`idSedes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_Rol1`
    FOREIGN KEY (`Rol`)
    REFERENCES `Base_bar`.`Rol` (`idRol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Base_bar`.`Login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_bar`.`Login` (
  `idLogin` INT NOT NULL AUTO_INCREMENT,
  `Contrasena` varchar(45) NOT NULL,
  `IdUsuario` BIGINT(100) NOT NULL,
  PRIMARY KEY (`idLogin`),
  CONSTRAINT `fk_Login_Usuarios1`
    FOREIGN KEY (`IdUsuario`)
    REFERENCES `Base_bar`.`Usuarios` (`idUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB default CHARSET=LATIN1;

-- -----------------------------------------------------
-- Table `Base_bar`.`Inventario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_bar`.`Inventario` (
  `idProductos` INT NOT NULL AUTO_INCREMENT,
  `Nombre_producto` VARCHAR(45) NOT NULL,
  `Cantidad_Uni` INT NOT NULL,
  `Valor_unidad` BIGINT(10) NOT NULL,
  `Producto_Sede` INT NULL,
  PRIMARY KEY (`idProductos`),
  CONSTRAINT `fk_Productos_Sedes1`
    FOREIGN KEY (`Producto_Sede`)
    REFERENCES `Base_bar`.`Sedes` (`idSedes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Base_bar`.`Mesas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_bar`.`Mesas` (
  `idMesas` BIGINT(100) NOT NULL AUTO_INCREMENT,
  `Numero_mesa` INT NOT NULL,
  `Estado` INT NOT NULL,
  `Mesa_Sedes` INT NOT NULL,
  PRIMARY KEY (`idMesas`),
  CONSTRAINT `fk_Mesas_Sedes1`
    FOREIGN KEY (`Mesa_Sedes`)
    REFERENCES `Base_bar`.`Sedes` (`idSedes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Base_bar`.`Ventas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_bar`.`Ventas` (
  `idVentas_Temp` BIGINT(100) NOT NULL AUTO_INCREMENT,
  `Cantidad` INT NOT NULL,
  `Valor_total` BIGINT(100) NOT NULL,
  `Fecha_Venta` DATETIME(6) NOT NULL,
  `Id_producto_inv` INT NULL,
  `Estado_venta` INT NOT NULL,
  `Id_sede` INT NULL,
  `Mesa_venta` BIGINT(100) NULL,
  PRIMARY KEY (`idVentas_Temp`),
  CONSTRAINT `fk_Ventas Temp_Productos10`
    FOREIGN KEY (`Id_producto_inv`)
    REFERENCES `Base_bar`.`Inventario` (`idProductos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ventas Temp_Sedes10`
    FOREIGN KEY (`Id_sede`)
    REFERENCES `Base_bar`.`Sedes` (`idSedes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ventas_Totales_Mesas1`
    FOREIGN KEY (`Mesa_venta`)
    REFERENCES `Base_bar`.`Mesas` (`idMesas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Base_bar`.`Ventas_totales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_bar`.`Ventas_totales` (
  `idVentas_Temp` BIGINT(100) NOT NULL AUTO_INCREMENT,
  `Cantidad` INT NOT NULL,
  `Valor_total` BIGINT(100) NOT NULL,
  `Fecha_Venta` DATETIME(6) NOT NULL,
  `Nombre_sede` VARCHAR(45) NOT NULL,
  `Nombre_producto` VARCHAR(45) NOT NULL,
  `Mesa_venta` BIGINT(100) NOT NULL,
  `Metodo_pago` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idVentas_Temp`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;