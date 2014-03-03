
//Base de datos/


*****************************************************************************

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `prueba` DEFAULT CHARACTER SET latin1 ;
USE `prueba` ;

-- -----------------------------------------------------
-- Table `prueba`.`tipo_moneda`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`tipo_moneda` (
  `ID_TIPO_MONEDA` INT NOT NULL AUTO_INCREMENT ,
  `NOMBRETM` MEDIUMTEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_TIPO_MONEDA`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`banco`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`banco` (
  `ID_BANCO` INT NOT NULL AUTO_INCREMENT ,
  `NOMBREBA` MEDIUMTEXT NULL DEFAULT NULL ,
  `NUMEROCUENTABA` INT NULL ,
  `SALDOBA` DECIMAL(11,3) NULL DEFAULT NULL ,
  `tipo_moneda_ID_TIPO_MONEDA` INT NOT NULL ,
  PRIMARY KEY (`ID_BANCO`, `tipo_moneda_ID_TIPO_MONEDA`) ,
  INDEX `fk_banco_tipo_moneda1_idx` (`tipo_moneda_ID_TIPO_MONEDA` ASC) ,
  CONSTRAINT `fk_banco_tipo_moneda1`
    FOREIGN KEY (`tipo_moneda_ID_TIPO_MONEDA` )
    REFERENCES `prueba`.`tipo_moneda` (`ID_TIPO_MONEDA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`cargo_cif`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`cargo_cif` (
  `ID_CARGO_CIF` INT NOT NULL AUTO_INCREMENT ,
  `COSTOCIF` DECIMAL(10,3) NULL ,
  `FLETECIF` DECIMAL(10,3) NULL DEFAULT NULL ,
  `PRIMACIF` DECIMAL(10,3) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_CARGO_CIF`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`cargo_otro`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`cargo_otro` (
  `ID_CARGO_OTROS` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `MARGEN_CO` DECIMAL(11,3) NULL COMMENT 'sacar un campo' ,
  `OTROCO` DECIMAL(10,0) NULL DEFAULT NULL COMMENT 'Sacar fila' ,
  PRIMARY KEY (`ID_CARGO_OTROS`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`carpeta_relacionada`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`carpeta_relacionada` (
  `ID_CARPETA_RELACIONA` INT NOT NULL AUTO_INCREMENT ,
  `NUMEROCARPETACR` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_CARPETA_RELACIONA`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`tipo_estado_t`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`tipo_estado_t` (
  `ID_TIPO_ESTADO_T` INT NOT NULL AUTO_INCREMENT ,
  `NOMBRETE` MEDIUMTEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_TIPO_ESTADO_T`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`tipo_transaccion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`tipo_transaccion` (
  `ID_TIPO_TRANSACCION` INT NOT NULL AUTO_INCREMENT ,
  `NOMBRETT` MEDIUMTEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_TIPO_TRANSACCION`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`transaccion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`transaccion` (
  `ID_TRANSACCION` INT NOT NULL AUTO_INCREMENT ,
  `MONTOT` DECIMAL(10,0) NULL DEFAULT NULL ,
  `DETALLET` MEDIUMTEXT NULL DEFAULT NULL ,
  `FECHAT` DATE NULL DEFAULT NULL ,
  `banco_ID_BANCO` INT NOT NULL ,
  `tipo_transaccion_ID_TIPO_TRANSACCION` INT NOT NULL ,
  PRIMARY KEY (`ID_TRANSACCION`, `banco_ID_BANCO`, `tipo_transaccion_ID_TIPO_TRANSACCION`) ,
  INDEX `fk_transaccion_banco1_idx` (`banco_ID_BANCO` ASC) ,
  INDEX `fk_transaccion_tipo_transaccion1_idx` (`tipo_transaccion_ID_TIPO_TRANSACCION` ASC) ,
  CONSTRAINT `fk_transaccion_banco1`
    FOREIGN KEY (`banco_ID_BANCO` )
    REFERENCES `prueba`.`banco` (`ID_BANCO` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaccion_tipo_transaccion1`
    FOREIGN KEY (`tipo_transaccion_ID_TIPO_TRANSACCION` )
    REFERENCES `prueba`.`tipo_transaccion` (`ID_TIPO_TRANSACCION` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`cheque`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`cheque` (
  `ID_CHEQUE` INT NOT NULL AUTO_INCREMENT COMMENT 'Solo si el tipo transacciones es cheque\n	' ,
  `NUMEROCH` DECIMAL(10,0) NULL DEFAULT NULL ,
  `tipo_estado_t_ID_TIPO_ESTADO_T` INT NOT NULL ,
  `transaccion_ID_TRANSACCION` INT NOT NULL ,
  PRIMARY KEY (`ID_CHEQUE`, `transaccion_ID_TRANSACCION`) ,
  INDEX `fk_cheque_tipo_estado_t1_idx` (`tipo_estado_t_ID_TIPO_ESTADO_T` ASC) ,
  UNIQUE INDEX `ID_CHEQUE_UNIQUE` (`ID_CHEQUE` ASC) ,
  INDEX `fk_cheque_transaccion1_idx` (`transaccion_ID_TRANSACCION` ASC) ,
  CONSTRAINT `fk_cheque_tipo_estado_t1`
    FOREIGN KEY (`tipo_estado_t_ID_TIPO_ESTADO_T` )
    REFERENCES `prueba`.`tipo_estado_t` (`ID_TIPO_ESTADO_T` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cheque_transaccion1`
    FOREIGN KEY (`transaccion_ID_TRANSACCION` )
    REFERENCES `prueba`.`transaccion` (`ID_TRANSACCION` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`tipo_carga`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`tipo_carga` (
  `ID_CARGA` INT NOT NULL AUTO_INCREMENT COMMENT 'cuando viene \"suelta o consolidadad\"\n\"container completa\" ' ,
  `NOMBRECA` CHAR(10) NULL ,
  `ValorNumerico` INT NULL ,
  PRIMARY KEY (`ID_CARGA`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`tipo_derechos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`tipo_derechos` (
  `ID_TIPO_DERECHOS` INT NOT NULL AUTO_INCREMENT ,
  `NOMBRETDE` MEDIUMTEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_TIPO_DERECHOS`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`remesa_aduana`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`remesa_aduana` (
  `ID_REMESAS_ADUANA` INT NOT NULL AUTO_INCREMENT ,
  `NUMEROCARPETARA` INT NULL ,
  `PROVEEDORRA` MEDIUMTEXT NULL DEFAULT NULL ,
  `FECHARA` DATE NULL DEFAULT NULL ,
  `tipo_carga_ID_CARGA` INT NOT NULL ,
  `cargo_cif_ID_CARGO_CIF` INT NOT NULL ,
  `cargo_otro_ID_CARGO_OTROS` INT NULL ,
  `tipo_derechos_ID_TIPO_DERECHOS` INT NOT NULL ,
  `carpeta_relacionada_ID_CARPETA_RELACIONA` INT NULL ,
  `TotalRemesas` INT NULL ,
  PRIMARY KEY (`ID_REMESAS_ADUANA`, `tipo_carga_ID_CARGA`, `cargo_cif_ID_CARGO_CIF`, `cargo_otro_ID_CARGO_OTROS`, `tipo_derechos_ID_TIPO_DERECHOS`, `carpeta_relacionada_ID_CARPETA_RELACIONA`) ,
  INDEX `fk_remesa_aduana_tipo_carga1_idx` (`tipo_carga_ID_CARGA` ASC) ,
  INDEX `fk_remesa_aduana_cargo_cif1_idx` (`cargo_cif_ID_CARGO_CIF` ASC) ,
  INDEX `fk_remesa_aduana_cargo_otro1_idx` (`cargo_otro_ID_CARGO_OTROS` ASC) ,
  INDEX `fk_remesa_aduana_tipo_derechos1_idx` (`tipo_derechos_ID_TIPO_DERECHOS` ASC) ,
  INDEX `fk_remesa_aduana_carpeta_relacionada1_idx` (`carpeta_relacionada_ID_CARPETA_RELACIONA` ASC) ,
  CONSTRAINT `fk_remesa_aduana_tipo_carga1`
    FOREIGN KEY (`tipo_carga_ID_CARGA` )
    REFERENCES `prueba`.`tipo_carga` (`ID_CARGA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_remesa_aduana_cargo_cif1`
    FOREIGN KEY (`cargo_cif_ID_CARGO_CIF` )
    REFERENCES `prueba`.`cargo_cif` (`ID_CARGO_CIF` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_remesa_aduana_cargo_otro1`
    FOREIGN KEY (`cargo_otro_ID_CARGO_OTROS` )
    REFERENCES `prueba`.`cargo_otro` (`ID_CARGO_OTROS` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_remesa_aduana_tipo_derechos1`
    FOREIGN KEY (`tipo_derechos_ID_TIPO_DERECHOS` )
    REFERENCES `prueba`.`tipo_derechos` (`ID_TIPO_DERECHOS` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_remesa_aduana_carpeta_relacionada1`
    FOREIGN KEY (`carpeta_relacionada_ID_CARPETA_RELACIONA` )
    REFERENCES `prueba`.`carpeta_relacionada` (`ID_CARPETA_RELACIONA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `prueba`.`forma_de_pago`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`forma_de_pago` (
  `ID_FORMA_PAGO` INT NOT NULL AUTO_INCREMENT ,
  `NOMBREFP` MEDIUMTEXT NULL DEFAULT NULL COMMENT 'carta credito, cheque, transferencia' ,
  PRIMARY KEY (`ID_FORMA_PAGO`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`tipo_estado_c`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`tipo_estado_c` (
  `ID_TIPO_ESTADO_C` INT NOT NULL AUTO_INCREMENT ,
  `NOMBRETEC` MEDIUMTEXT BINARY NULL DEFAULT NULL COMMENT 'pagado o no pagado\n' ,
  PRIMARY KEY (`ID_TIPO_ESTADO_C`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`tipo_estado_bodega`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`tipo_estado_bodega` (
  `ID_TIPO_ESTADO_BODEGA` INT NOT NULL AUTO_INCREMENT ,
  `NOMBRETEB` MEDIUMTEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_TIPO_ESTADO_BODEGA`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`coberturas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`coberturas` (
  `ID_COBERTURAS` INT NOT NULL AUTO_INCREMENT ,
  `FECHAFLUJOCO` DATE NULL DEFAULT NULL ,
  `remesa_aduana_ID_REMESAS_ADUANA` INT NOT NULL ,
  `forma_de_pago_ID_FORMA_PAGO` INT NOT NULL ,
  `banco_ID_BANCO` INT NOT NULL ,
  `tipo_estado_c_ID_TIPO_ESTADO_C` INT NOT NULL ,
  `tipo_estado_bodega_ID_TIPO_ESTADO_BODEGA` INT NOT NULL ,
  `Tolerancia` DECIMAL(2,2) NULL COMMENT 'Tolerancia: para el compara el pago total de la cobertura con su remesa\n' ,
  `transaccion_ID_TRANSACCION` INT NOT NULL ,
  PRIMARY KEY (`ID_COBERTURAS`, `remesa_aduana_ID_REMESAS_ADUANA`, `forma_de_pago_ID_FORMA_PAGO`, `banco_ID_BANCO`, `tipo_estado_c_ID_TIPO_ESTADO_C`, `tipo_estado_bodega_ID_TIPO_ESTADO_BODEGA`, `transaccion_ID_TRANSACCION`) ,
  INDEX `fk_coberturas_remesa_aduana1_idx` (`remesa_aduana_ID_REMESAS_ADUANA` ASC) ,
  INDEX `fk_coberturas_forma_de_pago1_idx` (`forma_de_pago_ID_FORMA_PAGO` ASC) ,
  INDEX `fk_coberturas_banco1_idx` (`banco_ID_BANCO` ASC) ,
  INDEX `fk_coberturas_tipo_estado_c1_idx` (`tipo_estado_c_ID_TIPO_ESTADO_C` ASC) ,
  INDEX `fk_coberturas_tipo_estado_bodega1_idx` (`tipo_estado_bodega_ID_TIPO_ESTADO_BODEGA` ASC) ,
  INDEX `fk_coberturas_transaccion1_idx` (`transaccion_ID_TRANSACCION` ASC) ,
  CONSTRAINT `fk_coberturas_remesa_aduana1`
    FOREIGN KEY (`remesa_aduana_ID_REMESAS_ADUANA` )
    REFERENCES `prueba`.`remesa_aduana` (`ID_REMESAS_ADUANA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coberturas_forma_de_pago1`
    FOREIGN KEY (`forma_de_pago_ID_FORMA_PAGO` )
    REFERENCES `prueba`.`forma_de_pago` (`ID_FORMA_PAGO` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coberturas_banco1`
    FOREIGN KEY (`banco_ID_BANCO` )
    REFERENCES `prueba`.`banco` (`ID_BANCO` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coberturas_tipo_estado_c1`
    FOREIGN KEY (`tipo_estado_c_ID_TIPO_ESTADO_C` )
    REFERENCES `prueba`.`tipo_estado_c` (`ID_TIPO_ESTADO_C` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coberturas_tipo_estado_bodega1`
    FOREIGN KEY (`tipo_estado_bodega_ID_TIPO_ESTADO_BODEGA` )
    REFERENCES `prueba`.`tipo_estado_bodega` (`ID_TIPO_ESTADO_BODEGA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coberturas_transaccion1`
    FOREIGN KEY (`transaccion_ID_TRANSACCION` )
    REFERENCES `prueba`.`transaccion` (`ID_TRANSACCION` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`tipo_doc`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`tipo_doc` (
  `ID_TIPO_DOC` INT NOT NULL AUTO_INCREMENT ,
  `NOMBRETDC` MEDIUMTEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_TIPO_DOC`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`plazo_doc`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`plazo_doc` (
  `ID_PLAZO_DOC` INT NOT NULL AUTO_INCREMENT ,
  `DIAZPD` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_PLAZO_DOC`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`docu_x_cobrar`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`docu_x_cobrar` (
  `ID_DOCU_X_COBRAR` INT NOT NULL AUTO_INCREMENT ,
  `MONTO` DECIMAL(10,0) NULL DEFAULT NULL ,
  `FECHADC` CHAR(10) NULL DEFAULT NULL ,
  `tipo_doc_ID_TIPO_DOC` INT NOT NULL ,
  `plazo_doc_ID_PLAZO_DOC` INT NOT NULL ,
  PRIMARY KEY (`ID_DOCU_X_COBRAR`, `tipo_doc_ID_TIPO_DOC`, `plazo_doc_ID_PLAZO_DOC`) ,
  INDEX `fk_docu_x_cobrar_tipo_doc1_idx` (`tipo_doc_ID_TIPO_DOC` ASC) ,
  INDEX `fk_docu_x_cobrar_plazo_doc1_idx` (`plazo_doc_ID_PLAZO_DOC` ASC) ,
  CONSTRAINT `fk_docu_x_cobrar_tipo_doc1`
    FOREIGN KEY (`tipo_doc_ID_TIPO_DOC` )
    REFERENCES `prueba`.`tipo_doc` (`ID_TIPO_DOC` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_docu_x_cobrar_plazo_doc1`
    FOREIGN KEY (`plazo_doc_ID_PLAZO_DOC` )
    REFERENCES `prueba`.`plazo_doc` (`ID_PLAZO_DOC` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`tipo_dolar`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`tipo_dolar` (
  `ID_TIPO_DOLAR` INT NOT NULL AUTO_INCREMENT ,
  `NOMBRETDO` MEDIUMTEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_TIPO_DOLAR`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`dolar`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`dolar` (
  `ID_DOLAR` INT NOT NULL AUTO_INCREMENT ,
  `VALOR` DECIMAL(10,3) NULL DEFAULT NULL ,
  `tipo_dolar_ID_TIPO_DOLAR` INT NOT NULL ,
  `FECHADO` DATE NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_DOLAR`, `tipo_dolar_ID_TIPO_DOLAR`) ,
  INDEX `fk_dolar_tipo_dolar1_idx` (`tipo_dolar_ID_TIPO_DOLAR` ASC) ,
  CONSTRAINT `fk_dolar_tipo_dolar1`
    FOREIGN KEY (`tipo_dolar_ID_TIPO_DOLAR` )
    REFERENCES `prueba`.`tipo_dolar` (`ID_TIPO_DOLAR` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`usuario` (
  `ID_USUARIO` INT NOT NULL AUTO_INCREMENT ,
  `NOMBRE_1` MEDIUMTEXT NULL DEFAULT NULL ,
  `NOMBRE_2` MEDIUMTEXT NULL DEFAULT NULL ,
  `AP_PA` MEDIUMTEXT NULL DEFAULT NULL ,
  `AP_MA` MEDIUMTEXT NULL DEFAULT NULL ,
  `RUT` DECIMAL(8,0) NULL DEFAULT NULL ,
  `RUT_DV` CHAR(1) NULL DEFAULT NULL ,
  `USER_LOGIN` MEDIUMTEXT NULL DEFAULT NULL ,
  `PASSWORD` MEDIUMTEXT NULL DEFAULT NULL ,
  `ESTADO` TINYINT(1) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_USUARIO`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`permisos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`permisos` (
  `ID_PERMISOS` INT NOT NULL AUTO_INCREMENT ,
  `NOMBREPERM` MEDIUMTEXT NULL DEFAULT NULL ,
  `ESTADO_VER` TINYINT(1) NULL DEFAULT NULL ,
  `ESTADO_EDICION` TINYINT(1) NULL DEFAULT NULL ,
  `ESTADO_IMPRECION` TINYINT(1) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_PERMISOS`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`Perfil_Modulos_Usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`Perfil_Modulos_Usuario` (
  `idPerfil_Usuario` INT NOT NULL AUTO_INCREMENT ,
  `NombrePERF` MEDIUMTEXT NULL ,
  `permisos_ID_PERMISOS` INT NOT NULL ,
  PRIMARY KEY (`idPerfil_Usuario`, `permisos_ID_PERMISOS`) ,
  INDEX `fk_Perfil_Usuario_permisos1_idx` (`permisos_ID_PERMISOS` ASC) ,
  CONSTRAINT `fk_Perfil_Usuario_permisos1`
    FOREIGN KEY (`permisos_ID_PERMISOS` )
    REFERENCES `prueba`.`permisos` (`ID_PERMISOS` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`Perfil_Vistas_Usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`Perfil_Vistas_Usuario` (
  `ID_PERMISOS_ESP` INT NOT NULL AUTO_INCREMENT ,
  `NOMBREPERM_E` MEDIUMTEXT NULL DEFAULT NULL ,
  `ESTADOPERM_E` TINYINT(1) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_PERMISOS_ESP`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`Usuario_vs_Perfil`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`Usuario_vs_Perfil` (
  `ID_USUVSPER` INT NULL AUTO_INCREMENT ,
  `usuario_ID_USUARIO` INT NULL ,
  `Perfil_Usuario_idPerfil_Usuario` INT NULL ,
  `Perfil_Especial_ID_PERFIL_ESPECIAL` INT NULL ,
  `ent_362_ID_PERMISOS_ESP` INT NULL ,
  PRIMARY KEY (`ID_USUVSPER`, `usuario_ID_USUARIO`, `Perfil_Usuario_idPerfil_Usuario`, `Perfil_Especial_ID_PERFIL_ESPECIAL`, `ent_362_ID_PERMISOS_ESP`) ,
  INDEX `fk_Usuario_vs_Perfil_usuario1_idx` (`usuario_ID_USUARIO` ASC) ,
  INDEX `fk_Usuario_vs_Perfil_Perfil_Usuario1_idx` (`Perfil_Usuario_idPerfil_Usuario` ASC) ,
  INDEX `fk_Usuario_vs_Perfil_ent_3621_idx` (`ent_362_ID_PERMISOS_ESP` ASC) ,
  CONSTRAINT `fk_Usuario_vs_Perfil_usuario1`
    FOREIGN KEY (`usuario_ID_USUARIO` )
    REFERENCES `prueba`.`usuario` (`ID_USUARIO` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_vs_Perfil_Perfil_Usuario1`
    FOREIGN KEY (`Perfil_Usuario_idPerfil_Usuario` )
    REFERENCES `prueba`.`Perfil_Modulos_Usuario` (`idPerfil_Usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_vs_Perfil_ent_3621`
    FOREIGN KEY (`ent_362_ID_PERMISOS_ESP` )
    REFERENCES `prueba`.`Perfil_Vistas_Usuario` (`ID_PERMISOS_ESP` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`Cargos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`Cargos` (
  `idCargos` INT NOT NULL AUTO_INCREMENT ,
  `Titulo` VARCHAR(45) NULL ,
  `Descripcion` VARCHAR(45) NULL ,
  PRIMARY KEY (`idCargos`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`Usuario_vs_Cargos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`Usuario_vs_Cargos` (
  `idUsuario_vs_Cargos` INT NOT NULL AUTO_INCREMENT ,
  `Cargos_idCargos` INT NOT NULL ,
  `usuario_ID_USUARIO` INT NOT NULL ,
  PRIMARY KEY (`idUsuario_vs_Cargos`, `Cargos_idCargos`, `usuario_ID_USUARIO`) ,
  INDEX `fk_Usuario_vs_Usuario_Cargos1_idx` (`Cargos_idCargos` ASC) ,
  INDEX `fk_Usuario_vs_Usuario_usuario1_idx` (`usuario_ID_USUARIO` ASC) ,
  CONSTRAINT `fk_Usuario_vs_Usuario_Cargos1`
    FOREIGN KEY (`Cargos_idCargos` )
    REFERENCES `prueba`.`Cargos` (`idCargos` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_vs_Usuario_usuario1`
    FOREIGN KEY (`usuario_ID_USUARIO` )
    REFERENCES `prueba`.`usuario` (`ID_USUARIO` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`Usuario_vs_Modificacion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`Usuario_vs_Modificacion` (
  `idUsuario_vs_Modificacion` INT NOT NULL AUTO_INCREMENT ,
  `fecha` DATETIME NOT NULL ,
  `Tipo_Modificacion` VARCHAR(45) NOT NULL COMMENT 'agregar\nmodificar' ,
  `remesa_aduana_ID_REMESAS_ADUANA` INT NOT NULL ,
  `coberturas_ID_COBERTURAS` INT NOT NULL ,
  `transaccion_ID_TRANSACCION` INT NOT NULL ,
  `usuario_ID_USUARIO` INT NOT NULL ,
  `docu_x_cobrar_ID_DOCU_X_COBRAR` INT NOT NULL ,
  `docu_x_cobrar_tipo_doc_ID_TIPO_DOC` INT NOT NULL ,
  `docu_x_cobrar_plazo_doc_ID_PLAZO_DOC` INT NOT NULL ,
  PRIMARY KEY (`idUsuario_vs_Modificacion`, `remesa_aduana_ID_REMESAS_ADUANA`, `coberturas_ID_COBERTURAS`, `transaccion_ID_TRANSACCION`, `usuario_ID_USUARIO`, `docu_x_cobrar_ID_DOCU_X_COBRAR`, `docu_x_cobrar_tipo_doc_ID_TIPO_DOC`, `docu_x_cobrar_plazo_doc_ID_PLAZO_DOC`) ,
  INDEX `fk_Usuario_vs_Modificacion_remesa_aduana1_idx` (`remesa_aduana_ID_REMESAS_ADUANA` ASC) ,
  INDEX `fk_Usuario_vs_Modificacion_coberturas1_idx` (`coberturas_ID_COBERTURAS` ASC) ,
  INDEX `fk_Usuario_vs_Modificacion_transaccion1_idx` (`transaccion_ID_TRANSACCION` ASC) ,
  INDEX `fk_Usuario_vs_Modificacion_usuario1_idx` (`usuario_ID_USUARIO` ASC) ,
  INDEX `fk_Usuario_vs_Modificacion_docu_x_cobrar1_idx` (`docu_x_cobrar_ID_DOCU_X_COBRAR` ASC, `docu_x_cobrar_tipo_doc_ID_TIPO_DOC` ASC, `docu_x_cobrar_plazo_doc_ID_PLAZO_DOC` ASC) ,
  CONSTRAINT `fk_Usuario_vs_Modificacion_remesa_aduana1`
    FOREIGN KEY (`remesa_aduana_ID_REMESAS_ADUANA` )
    REFERENCES `prueba`.`remesa_aduana` (`ID_REMESAS_ADUANA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_vs_Modificacion_coberturas1`
    FOREIGN KEY (`coberturas_ID_COBERTURAS` )
    REFERENCES `prueba`.`coberturas` (`ID_COBERTURAS` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_vs_Modificacion_transaccion1`
    FOREIGN KEY (`transaccion_ID_TRANSACCION` )
    REFERENCES `prueba`.`transaccion` (`ID_TRANSACCION` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_vs_Modificacion_usuario1`
    FOREIGN KEY (`usuario_ID_USUARIO` )
    REFERENCES `prueba`.`usuario` (`ID_USUARIO` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_vs_Modificacion_docu_x_cobrar1`
    FOREIGN KEY (`docu_x_cobrar_ID_DOCU_X_COBRAR` , `docu_x_cobrar_tipo_doc_ID_TIPO_DOC` , `docu_x_cobrar_plazo_doc_ID_PLAZO_DOC` )
    REFERENCES `prueba`.`docu_x_cobrar` (`ID_DOCU_X_COBRAR` , `tipo_doc_ID_TIPO_DOC` , `plazo_doc_ID_PLAZO_DOC` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`saldo_historial_banco`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`saldo_historial_banco` (
  `idsaldo_historial_banco` INT NOT NULL AUTO_INCREMENT ,
  `saldo_final_dia` DECIMAL(11,3) NULL ,
  `fecha` DATE NULL ,
  `banco_ID_BANCO` INT NOT NULL ,
  PRIMARY KEY (`idsaldo_historial_banco`, `banco_ID_BANCO`) ,
  INDEX `fk_saldo_historial_banco_banco1_idx` (`banco_ID_BANCO` ASC) ,
  CONSTRAINT `fk_saldo_historial_banco_banco1`
    FOREIGN KEY (`banco_ID_BANCO` )
    REFERENCES `prueba`.`banco` (`ID_BANCO` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prueba`.`tolerancia_cobertura`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `prueba`.`tolerancia_cobertura` (
  `idTolerancia` INT NOT NULL ,
  `toleranciaCobertura` DECIMAL(2,2) NOT NULL COMMENT 'tolerancia de perdida para cubrir una remesa\n' ,
  PRIMARY KEY (`idTolerancia`) )
ENGINE = InnoDB;

USE `prueba` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-----------------------------------------------------------------------------------
-----------------------------------------------------------------------------------


--MYSQL LLENADO DE DATOS BÁSICOS--

INSERT INTO usuario(NOMBRE_1, NOMBRE_2, AP_PA, AP_MA, RUT, RUT_DV, USER_LOGIN, PASSWORD, ESTADO) VALUES('ADMINISTRADOR ','TOTAL','DEL SISTEMA','FINANZA-ESTADISTICO',1,'9','ADMIN','1234',1);
INSERT INTO Cargos(Titulo, Descripcion) VALUES('ADMINISTRADOR','ADMINISTRADOR DEL SISTEMA');
INSERT INTO Usuario_vs_Cargos(Cargos_IdCargos, usuario_ID_USUARIO) VALUES(1,1);
INSERT INTO tipo_dolar VALUES(1,'Aduana');
INSERT INTO tipo_dolar VALUES(2,'Cobertura');
INSERT INTO tipo_estado_bodega values(1,'En Transito');
INSERT INTO tipo_estado_bodega values(2,'En Puerto');
INSERT INTO tipo_estado_bodega values(3,'En Bodega');
INSERT INTO dolar VALUES(1,472.28,1,'2013-12-11');
INSERT INTO dolar VALUES(2,472.28,2,'2013-12-11');
INSERT INTO forma_de_pago values(1,'Carta de Crédito');
INSERT INTO forma_de_pago values(2,'Cheque');
INSERT INTO forma_de_pago values(3,'Tranferencia');
INSERT INTO tipo_carga values(1,'Pack de 12',12);
INSERT INTO tipo_carga values(2,'Lote Completo',10000);
INSERT INTO tipo_derechos values(1,'0');
INSERT INTO tipo_derechos values(2,'6');
