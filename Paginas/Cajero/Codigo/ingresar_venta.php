<?php
session_start();
if (empty($_SESSION["idUsuarios"])) {
    header("location:../../../login.php");
}

require "../../../Modelo/conexion.php";
$sede = $_SESSION["Usuario_Sede"];

$id_venta = $_POST['id_venta'];
$mesa = $_POST['mesa'];
$metodo = $_POST['Metodo_pago'];

for ($i = 0; $i < count($id_venta); $i++) {
    $id = $id_venta[$i];
    $sql_subir_venta = "insert into `base_bar`.`Ventas_totales` (`Cantidad`, `Valor_total`, `Fecha_Venta`, `Nombre_sede`, `Nombre_producto`, `Mesa_venta`, `Metodo_pago`) 
                        select ventas.Cantidad, ventas.Valor_total, ventas.Fecha_Venta,sedes.Nombre, inv.Nombre_producto, ventas.Mesa_venta, '$metodo' 
                        from `base_bar`.`ventas` as ventas 
                        inner join `base_bar`.`sedes` as sedes on ventas.Id_sede = sedes.idSedes 
                        inner join `base_bar`.`inventario` as inv on ventas.Id_producto_inv = inv.idProductos WHERE (ventas.idVentas_Temp = '$id') and ventas.Cantidad <> 0 and ventas.Valor_total <> 0";
    if (mysqli_query($conexion, $sql_subir_venta)) {
        echo "venta subida";
    }
    $sql_estado_venta = "UPDATE `base_bar`.`ventas` SET `Estado_venta` = '1' WHERE (`idVentas_Temp` = '$id')";
    if (mysqli_query($conexion, $sql_estado_venta)) {
        echo "mesa actualizada";
    }
    $sql_estado_mesa = "UPDATE `base_bar`.`mesas` SET `Estado` = '0' WHERE (`idMesas` = '$mesa')";
        if (mysqli_query($conexion, $sql_estado_mesa)) {
        echo "mesa actualizada";
    }
     
    $_SESSION['status'] = "Venta facturada";
        header('location: http://localhost/Bar/Paginas/Cajero/main.php');
    }



?>