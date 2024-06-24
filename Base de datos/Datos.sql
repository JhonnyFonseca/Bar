INSERT INTO `base_bar`.`sedes` (`Nombre`, `Direccion`, `Ciudad`) VALUES ('C.C. El alma local 101', 'Cr 1 #1-1', 'Barranquilla');
INSERT INTO `base_bar`.`sedes` (`Nombre`, `Direccion`, `Ciudad`) VALUES ('C.C. Plaza imperial local 201-205', 'Cr 1 #2-2', 'Bogota');
INSERT INTO `base_bar`.`sedes` (`Nombre`, `Direccion`, `Ciudad`) VALUES ('Barrio chiringuito', 'Cr 1 #3-3', 'Cali');

INSERT INTO `base_bar`.`rol` (`idRol`, `Rol`) VALUES ('1', 'Administrador');
INSERT INTO `base_bar`.`rol` (`idRol`, `Rol`) VALUES ('2', 'Mesero');
INSERT INTO `base_bar`.`rol` (`idRol`, `Rol`) VALUES ('3', 'Cajero');

INSERT INTO `base_bar`.`usuarios` (`idUsuarios`, `Nombre`, `Apellido`, `Rol`, `Celular`) VALUES ('100123456', 'Gabriel', 'Fernandez', '1', '3124657980');
INSERT INTO `base_bar`.`usuarios` (`idUsuarios`, `Nombre`, `Apellido`, `Rol`, `Celular`, `Usuario_Sede`) VALUES ('5146235', 'Fernando', 'Orjuela', '2', '12456789', '2');
INSERT INTO `base_bar`.`usuarios` (`idUsuarios`, `Nombre`, `Apellido`, `Rol`, `Celular`, `Usuario_Sede`) VALUES ('45678932', 'Luis', 'Diaz', '3', '4564896', '2');
INSERT INTO `base_bar`.`usuarios` (`idUsuarios`, `Nombre`, `Apellido`, `Rol`, `Celular`, `Usuario_Sede`) VALUES ('79846516', 'Armando', 'Puentes', '2', '23165456456', '3');
INSERT INTO `base_bar`.`usuarios` (`idUsuarios`, `Nombre`, `Apellido`, `Rol`, `Celular`, `Usuario_Sede`) VALUES ('469132189', 'Elizabeth', 'Castro', '3', '4665123312', '3');
INSERT INTO `base_bar`.`usuarios` (`idUsuarios`, `Nombre`, `Apellido`, `Rol`, `Celular`, `Usuario_Sede`) VALUES ('456789', 'Angel', 'Rosio', '2', '4654646546', '1');
INSERT INTO `base_bar`.`usuarios` (`idUsuarios`, `Nombre`, `Apellido`, `Rol`, `Celular`, `Usuario_Sede`) VALUES ('987654', 'Mirio', 'Anuel', '3', '7979879798', '1');


INSERT INTO `base_bar`.`login` (`Contrasena`, `IdUsuario`) VALUES (aes_encrypt('123456', 'AES'), '100123456');
INSERT INTO `base_bar`.`login` (`Contrasena`, `IdUsuario`) VALUES (aes_encrypt('123456', 'AES'), '5146235');
INSERT INTO `base_bar`.`login` (`Contrasena`, `IdUsuario`) VALUES (aes_encrypt('123456', 'AES'), '45678932');
INSERT INTO `base_bar`.`login` (`Contrasena`, `IdUsuario`) VALUES (aes_encrypt('123456', 'AES'), '79846516');
INSERT INTO `base_bar`.`login` (`Contrasena`, `IdUsuario`) VALUES (aes_encrypt('123456', 'AES'),'469132189');
INSERT INTO `base_bar`.`login` (`Contrasena`, `IdUsuario`) VALUES (aes_encrypt('123456', 'AES'),'456789');
INSERT INTO `base_bar`.`login` (`Contrasena`, `IdUsuario`) VALUES (aes_encrypt('123456', 'AES'),'987654');

INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('1', '1', '0');
INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('2', '1', '0');
INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('3', '1', '0');
INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('4', '1', '0');
INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('5', '1', '0');
INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('1', '2', '0');
INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('2', '2', '0');
INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('3', '2', '0');
INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('4', '2', '0');
INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('1', '3', '0');
INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('2', '3', '0');
INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('3', '3', '0');
INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('4', '3', '0');

INSERT INTO `base_bar`.`inventario` (`Nombre_producto`, `Cantidad_Uni`, `Valor_unidad`, `Producto_Sede`) VALUES ('Cerveza alemana', '10', '1500', '1');
INSERT INTO `base_bar`.`inventario` (`Nombre_producto`, `Cantidad_Uni`, `Valor_unidad`, `Producto_Sede`) VALUES ('Aguardiente nectar', '5', '45000', '1');
INSERT INTO `base_bar`.`inventario` (`Nombre_producto`, `Cantidad_Uni`, `Valor_unidad`, `Producto_Sede`) VALUES ('Ron viejo caldas', '8', '150000', '1');
INSERT INTO `base_bar`.`inventario` (`Nombre_producto`, `Cantidad_Uni`, `Valor_unidad`, `Producto_Sede`) VALUES ('Cerveza alemana', '10', '1500', '2');
INSERT INTO `base_bar`.`inventario` (`Nombre_producto`, `Cantidad_Uni`, `Valor_unidad`, `Producto_Sede`) VALUES ('Aguardiente nectar', '5', '45000', '2');
INSERT INTO `base_bar`.`inventario` (`Nombre_producto`, `Cantidad_Uni`, `Valor_unidad`, `Producto_Sede`) VALUES ('Ron viejo caldas', '8', '150000', '2');
INSERT INTO `base_bar`.`inventario` (`Nombre_producto`, `Cantidad_Uni`, `Valor_unidad`, `Producto_Sede`) VALUES ('Cerveza alemana', '10', '1500', '3');
INSERT INTO `base_bar`.`inventario` (`Nombre_producto`, `Cantidad_Uni`, `Valor_unidad`, `Producto_Sede`) VALUES ('Aguardiente nectar', '5', '45000', '3');
INSERT INTO `base_bar`.`inventario` (`Nombre_producto`, `Cantidad_Uni`, `Valor_unidad`, `Producto_Sede`) VALUES ('Ron viejo caldas', '8', '150000', '3');

INSERT INTO `base_bar`.`ventas` (`Cantidad`, `Valor_total`, `Fecha_Venta`, `Id_producto_inv`, `Id_sede`, `Mesa_venta`, `Estado_venta`) VALUES ('2', '3000', '2024-04-21', '1', '1', '1', '1');
INSERT INTO `base_bar`.`ventas` (`Cantidad`, `Valor_total`, `Fecha_Venta`, `Id_producto_inv`, `Id_sede`, `Mesa_venta`, `Estado_venta`) VALUES ('2', '90000', '2024-04-21', '2', '1', '1', '1');
INSERT INTO `base_bar`.`ventas` (`Cantidad`, `Valor_total`, `Fecha_Venta`, `Id_producto_inv`, `Id_sede`, `Mesa_venta`, `Estado_venta`) VALUES ('2', '300000', '2024-04-21', '3', '1', '1', '1');
INSERT INTO `base_bar`.`ventas` (`Cantidad`, `Valor_total`, `Fecha_Venta`, `Id_producto_inv`, `Id_sede`, `Mesa_venta`, `Estado_venta`) VALUES ('2', '3000', '2024-04-20', '4', '2', '1', '1');
INSERT INTO `base_bar`.`ventas` (`Cantidad`, `Valor_total`, `Fecha_Venta`, `Id_producto_inv`, `Id_sede`, `Mesa_venta`, `Estado_venta`) VALUES ('2', '3000', '2024-04-21', '1', '1', '1', '1');

-- copia en una tabla permanente
insert into `base_bar`.`Ventas_totales` (`Cantidad`, `Valor_total`, `Fecha_Venta`, `Nombre_sede`, `Nombre_producto`, `Mesa_venta`, `Metodo_pago`) 
select ventas.Cantidad, ventas.Valor_total, ventas.Fecha_Venta,sedes.Nombre, inv.Nombre_producto, ventas.Mesa_venta, "Efectivo" 
from `base_bar`.`ventas` as ventas 
inner join `base_bar`.`sedes` as sedes on ventas.Id_sede = sedes.idSedes 
inner join `base_bar`.`inventario` as inv on ventas.Id_producto_inv = inv.idProductos;
