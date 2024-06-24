DELIMITER //

CREATE PROCEDURE BorrarSedes(
    IN id_Eliminado INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    -- Borrar login
    DELETE FROM `base_bar`.`Login` WHERE IdUsuario in (select idUsuarios from `base_bar`.`usuarios` where Usuario_Sede =id_Eliminado);
    
    -- Borrar usuarios
    DELETE FROM `base_bar`.`usuarios` WHERE Usuario_Sede = id_Eliminado;
	
	
    -- Borrar inventario
    DELETE FROM `base_bar`.`inventario` WHERE Producto_Sede = id_Eliminado;
    
    -- Borrar mesas
    DELETE FROM `base_bar`.`Mesas` WHERE Mesa_Sedes = id_Eliminado;
    
    -- Borrar datos de la tabla 'usuarios'
    DELETE FROM `base_bar`.`sedes` WHERE idSedes = id_Eliminado;
    
    COMMIT;
END//


CREATE PROCEDURE InsertarUsuario(
    IN idUsuario_in INT,
    Nombre_in varchar(50),
    Apellido_in varchar(50),
    Celular_in bigint(15),
    Usuario_sede_in int(11),
    rol_in int(11),
    Contrasena_in varchar(50)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    -- insertar usuario 
    INSERT INTO `base_bar`.`usuarios` (`idUsuarios`, `Nombre`, `Apellido`, `Rol`, `Celular`, `Usuario_Sede`) VALUES (idUsuario_in, Nombre_in, Apellido_in, rol_in, Celular_in, Usuario_sede_in);
    
    -- insertar login 
    INSERT INTO `base_bar`.`login` (`Contrasena`, `IdUsuario`) VALUES (aes_encrypt(Contrasena_in, 'AES'), idUsuario_in);
    
    COMMIT;
END//


CREATE PROCEDURE ActualizarUsuario(
    IN id_Actualizado INT,
    Nombre_up varchar(50),
    Apellido_up varchar(50),
    Celular_up bigint(15),
    Contrasena_up varchar(50)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    -- Actualizar usuario
    UPDATE `base_bar`.`usuarios` SET `Nombre` = Nombre_up, `Apellido` = Apellido_up, `Celular` = Celular_up
    WHERE (`idUsuarios` = id_Actualizado);
    
    -- Actualizar login
    UPDATE `base_bar`.`login` SET `Contrasena` = aes_encrypt(Contrasena_up, 'AES')
    WHERE (`idUsuario` = id_Actualizado);
    
    COMMIT;
END//


CREATE PROCEDURE BorrarUsuario(
    IN id_user_Eliminado INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    -- Borrar login
    DELETE FROM `base_bar`.`Login` WHERE IdUsuario = id_user_Eliminado;
    
    -- Borrar usuario
    DELETE FROM `base_bar`.`usuarios` WHERE idUsuarios = id_user_Eliminado;
    
    COMMIT;
END//

DELIMITER ;

