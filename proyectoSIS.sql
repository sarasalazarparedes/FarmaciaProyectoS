-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema proyectosis
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema proyectosis
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `proyectosis` DEFAULT CHARACTER SET utf8 ;
USE `proyectosis` ;

-- -----------------------------------------------------
-- Table `proyectosis`.`tipousuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`tipousuario` (
  `idtipoUsuario` INT(11) NOT NULL,
  `nombre_tipo` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idtipoUsuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `proyectosis`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`usuario` (
  `idusuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nombreU` VARCHAR(45) NULL DEFAULT NULL,
  `apellidoU` VARCHAR(45) NULL DEFAULT NULL,
  `edad` INT(11) NULL DEFAULT NULL,
  `cedulaU` VARCHAR(45) NULL DEFAULT NULL,
  `contra` VARCHAR(45) NULL DEFAULT NULL,
  `telefonoU` INT(11) NULL DEFAULT NULL,
  `residenciaU` VARCHAR(45) NULL DEFAULT NULL,
  `correoU` VARCHAR(45) NULL DEFAULT NULL,
  `adicionalU` VARCHAR(600) NULL DEFAULT NULL,
  `avatar` VARCHAR(300) NULL,
  `tipoUsuario_idtipoUsuario` INT(11) NOT NULL,
  PRIMARY KEY (`idusuario`),
  INDEX `fk_usuario_tipoUsuario1_idx` (`tipoUsuario_idtipoUsuario` ASC) ,
  CONSTRAINT `fk_usuario_tipoUsuario1`
    FOREIGN KEY (`tipoUsuario_idtipoUsuario`)
    REFERENCES `proyectosis`.`tipousuario` (`idtipoUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `proyectosis`.`venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`venta` (
  `idventa` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NULL DEFAULT NULL,
  `cliente` VARCHAR(45) NULL DEFAULT NULL,
  `cedula` VARCHAR(45) NULL DEFAULT NULL,
  `total` FLOAT NULL DEFAULT NULL,
  `usuario_idusuario` INT(11) NOT NULL,
  PRIMARY KEY (`idventa`),
  INDEX `fk_venta_usuario1_idx` (`usuario_idusuario` ASC) ,
  CONSTRAINT `fk_venta_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `proyectosis`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `proyectosis`.`detalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`detalle` (
  `iddetalle` INT(11) NOT NULL AUTO_INCREMENT,
  `cantidad` INT(11) NULL DEFAULT NULL,
  `vencimiento` DATE NULL DEFAULT NULL,
  `id_det_lote` INT(11) NULL DEFAULT NULL,
  `id_det_prod` INT(11) NULL DEFAULT NULL,
  `lote_id_prov` INT(11) NULL DEFAULT NULL,
  `venta_idventa` INT(11) NOT NULL,
  PRIMARY KEY (`iddetalle`),
  INDEX `fk_detalle_venta1_idx` (`venta_idventa` ASC) ,
  CONSTRAINT `fk_detalle_venta1`
    FOREIGN KEY (`venta_idventa`)
    REFERENCES `proyectosis`.`venta` (`idventa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `proyectosis`.`laboratorio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`laboratorio` (
  `idlaboratorio` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `avatar` VARCHAR(300) NULL,
  PRIMARY KEY (`idlaboratorio`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `proyectosis`.`presentacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`presentacion` (
  `idpresentacion` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idpresentacion`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `proyectosis`.`tipoproducto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`tipoproducto` (
  `idtipoProducto` INT(11) NOT NULL AUTO_INCREMENT,
  `caracteristica` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idtipoProducto`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `proyectosis`.`producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`producto` (
  `idproducto` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `concentrancion` VARCHAR(225) NULL DEFAULT NULL,
  `adicional` VARCHAR(225) NULL DEFAULT NULL,
  `laboratorio_idlaboratorio` INT(11) NOT NULL,
  `tipoProducto_idtipoProducto` INT(11) NOT NULL,
  `presentacion_idpresentacion` INT(11) NOT NULL,
  PRIMARY KEY (`idproducto`),
  INDEX `fk_producto_laboratorio_idx` (`laboratorio_idlaboratorio` ASC) ,
  INDEX `fk_producto_tipoProducto1_idx` (`tipoProducto_idtipoProducto` ASC) ,
  INDEX `fk_producto_presentacion1_idx` (`presentacion_idpresentacion` ASC) ,
  CONSTRAINT `fk_producto_laboratorio`
    FOREIGN KEY (`laboratorio_idlaboratorio`)
    REFERENCES `proyectosis`.`laboratorio` (`idlaboratorio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_presentacion1`
    FOREIGN KEY (`presentacion_idpresentacion`)
    REFERENCES `proyectosis`.`presentacion` (`idpresentacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_tipoProducto1`
    FOREIGN KEY (`tipoProducto_idtipoProducto`)
    REFERENCES `proyectosis`.`tipoproducto` (`idtipoProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `proyectosis`.`proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`proveedor` (
  `idproveedor` INT(11) NOT NULL,
  `nombre` VARCHAR(75) NULL DEFAULT NULL,
  `telefono` VARCHAR(45) NULL DEFAULT NULL,
  `correo` VARCHAR(45) NULL DEFAULT NULL,
  `direccion` VARCHAR(200) NULL,
  `avatar` VARCHAR(300) NULL,
  PRIMARY KEY (`idproveedor`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `proyectosis`.`lote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`lote` (
  `idlote` INT(11) NOT NULL,
  `stock` INT(11) NULL DEFAULT NULL,
  `vencimiento` DATE NULL DEFAULT NULL,
  `producto_idproducto` INT(11) NOT NULL,
  `proveedor_idproveedor` INT(11) NOT NULL,
  PRIMARY KEY (`idlote`),
  INDEX `fk_lote_producto1_idx` (`producto_idproducto` ASC) ,
  INDEX `fk_lote_proveedor1_idx` (`proveedor_idproveedor` ASC) ,
  CONSTRAINT `fk_lote_producto1`
    FOREIGN KEY (`producto_idproducto`)
    REFERENCES `proyectosis`.`producto` (`idproducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lote_proveedor1`
    FOREIGN KEY (`proveedor_idproveedor`)
    REFERENCES `proyectosis`.`proveedor` (`idproveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `proyectosis`.`ventaproducto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`ventaproducto` (
  `idventaProducto` INT(11) NOT NULL AUTO_INCREMENT,
  `cantidad` INT(11) NULL DEFAULT NULL,
  `subtotal` FLOAT NULL DEFAULT NULL,
  `producto_idproducto` INT(11) NOT NULL,
  `venta_idventa` INT(11) NOT NULL,
  PRIMARY KEY (`idventaProducto`),
  INDEX `fk_ventaProducto_producto1_idx` (`producto_idproducto` ASC) ,
  INDEX `fk_ventaProducto_venta1_idx` (`venta_idventa` ASC) ,
  CONSTRAINT `fk_ventaProducto_producto1`
    FOREIGN KEY (`producto_idproducto`)
    REFERENCES `proyectosis`.`producto` (`idproducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventaProducto_venta1`
    FOREIGN KEY (`venta_idventa`)
    REFERENCES `proyectosis`.`venta` (`idventa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `proyectosis`.`compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`compra` (
  `idcompra` INT NOT NULL AUTO_INCREMENT,
  `proveedor` VARCHAR(45) NULL,
  `fecha` DATETIME NULL,
  `producto` VARCHAR(45) NULL,
  `cantidad` INT NULL,
  `precio` FLOAT NULL,
  `vencimiento` DATETIME NULL,
  `laboratorio` VARCHAR(45) NULL,
  `presentacion` VARCHAR(45) NULL,
  `total` FLOAT NULL,
  PRIMARY KEY (`idcompra`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `proyectosis`.`compraproducto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectosis`.`compraproducto` (
  `idcompraproducto` INT NOT NULL AUTO_INCREMENT,
  `cantidad` INT NULL,
  `subtotal` FLOAT NULL,
  `compra_idcompra` INT NOT NULL,
  PRIMARY KEY (`idcompraproducto`),
  INDEX `fk_compraproducto_compra1_idx` (`compra_idcompra` ASC) ,
  CONSTRAINT `fk_compraproducto_compra1`
    FOREIGN KEY (`compra_idcompra`)
    REFERENCES `proyectosis`.`compra` (`idcompra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
