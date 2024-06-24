DELIMITER //

CREATE PROCEDURE InsertarSede(
IN cantidad INT,
nombre_sede varchar(45),
Direccion varchar(100),
Ciudad varchar(45)
)

BEGIN

    DECLARE contador INT DEFAULT 1;
    DECLARE Id INT DEFAULT 0;

    INSERT INTO `base_bar`.`sedes` (`Nombre`, `Direccion`, `Ciudad`) VALUES (nombre_sede, Direccion, Ciudad);
    
    SET Id = LAST_INSERT_ID(); 

    WHILE contador <= cantidad DO
        INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`, `Estado`) VALUES (contador, Id, '0'); -- Insertar el número con el ID de la sede
        SET contador = contador + 1;
    END WHILE;
    
END//


DELIMITER ;