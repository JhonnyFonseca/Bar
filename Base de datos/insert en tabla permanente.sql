-- copia en una tabla permanente
	insert into `base_bar`.`Ventas_totales` (`Cantidad`, `Valor_total`, `Fecha_Venta`, `Nombre_sede`, `Nombre_producto`, `Mesa_venta`) 
	select ventas.Cantidad, ventas.Valor_total, ventas.Fecha_Venta,sedes.Nombre, inv.Nombre_producto, ventas.Mesa_venta 
	from `base_bar`.`ventas` as ventas 
	inner join `base_bar`.`sedes` as sedes on ventas.Id_sede = sedes.idSedes 
	inner join `base_bar`.`inventario` as inv on ventas.Id_producto_inv = inv.idProductos;