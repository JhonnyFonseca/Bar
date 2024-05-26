<?php
session_start();
if (empty($_SESSION["idUsuarios"])) {
    header("location:../../../login.php");
}

$sede = $_SESSION["Usuario_Sede"];

if (isset($_POST["Gestionar_inventario"])) {
    require "../../../Modelo/conexion.php";
    
    $Nombre_producto = $_POST["Nombre_Prod"];
    $Cantidad_producto = $_POST["Cantidad_Prod"];
    $id_prod_update = $_POST["id_Prod_update"];

    $sql_select_prod = "SELECT Cantidad_Uni FROM base_bar.inventario where Producto_Sede = '$sede' and idProductos = '$id_prod_update'";
    $ExecSelectProd = mysqli_query($conexion, $sql_select_prod);
    $cantidad_of = mysqli_fetch_array($ExecSelectProd);

    $unidadDispo = $cantidad_of['Cantidad_Uni'];

    $cantidadInsert = $unidadDispo+$Cantidad_producto;

    if ($cantidadInsert < 0){
        $_SESSION['status'] = "El valor insertado no puede reducir la cantidad por debajo de ";
        header('location: http://localhost/Bar/Paginas/Cajero/inventario.php');
    }else{
        $sql_insert_prod = "UPDATE `base_bar`.`inventario` SET `Cantidad_Uni` = '$cantidadInsert' WHERE (`idProductos` = '$id_prod_update')";
        $ExecInsertProd = mysqli_query($conexion, $sql_insert_prod);
    
        if ($ExecInsertProd) {
            $_SESSION['status'] = "Datos insertados correctamente";
            header('location: http://localhost/Bar/Paginas/Cajero/inventario.php');
        }else{
            $_SESSION['status'] = "La inserción de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Cajero/inventario.php');
        }
    }

}



?>