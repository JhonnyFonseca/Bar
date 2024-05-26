<?php
    session_start();
    if (empty($_SESSION["idUsuarios"])) {
        header("location:../../../login.php");
    }

    if (isset($_POST["Cambiar_sede"])) {
        require "../../../Modelo/conexion.php";
        
        $Id_update = $_POST["Id_update"];
        $Nombre_sede = $_POST["Nombre_sede"];

        $Update_sede_sql = "UPDATE `base_bar`.`sedes` SET `Nombre` = '$Nombre_sede' WHERE (`idSedes` = '$Id_update')";
        $Exec_Update_sede_sql = mysqli_query($conexion, $Update_sede_sql);

        if ($Exec_Update_sede_sql) {
            $_SESSION['status'] = "Datos actualizados correctamente";
            header('location: http://localhost/Bar/Paginas/Administrador/sedes.php');
        }else{
            $_SESSION['status'] = "La actualización de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Administrador/sedes.php');
        }
    }

    if (isset($_POST["Cambiar_usuario"])) {
        require "../../../Modelo/conexion.php";
        
        $Id_update_user = $_POST["Id_update_usu"];
        $Nombre_usu = $_POST["Nombre_usuario"];
        $Apellido_usu = $_POST["Apellido_usuario"];
        $Celular_usu = $_POST["Celular_usuario"];
        $Contrasena_usu = $_POST["Contrasena_usuario"];

        $Update_sede_sql = "CALL ActualizarUsuario('$Id_update_user', '$Nombre_usu', '$Apellido_usu', '$Celular_usu', '$Contrasena_usu')";
        $Exec_Update_sede_sql = mysqli_query($conexion, $Update_sede_sql);

        if ($Exec_Update_sede_sql) {
            $_SESSION['status'] = "Datos actualizados correctamente";
            header('location: http://localhost/Bar/Paginas/Administrador/usuarios.php');
        }else{
            $_SESSION['status'] = "La actualización de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Administrador/usuarios.php');
        }
    }

    if (isset($_POST["Cambiar_Mesa"])) {
        require "../../../Modelo/conexion.php";
        
        $Id_update_Mesa = $_POST["Id_update_Mesa"];
        $Estado_mesa = $_POST["Estado_mesa"];

        $Update_Mesa_sql = "UPDATE `base_bar`.`mesas` SET `Estado` = '$Estado_mesa' WHERE (`idMesas` = '$Id_update_Mesa')";
        $Exec_Update_Mesa_sql = mysqli_query($conexion, $Update_Mesa_sql);

        if ($Exec_Update_Mesa_sql) {
            $_SESSION['status'] = "Datos actualizados correctamente";
            header('location: http://localhost/Bar/Paginas/Administrador/mesas.php');
        }else{
            $_SESSION['status'] = "La actualización de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Administrador/mesas.php');
        }
    }

    if (isset($_POST["Cambiar_Producto"])) {
        require "../../../Modelo/conexion.php";
        
        $id_Prod_update = $_POST["id_Prod_update"];
        $Nombre_Prod = $_POST["Nombre_Prod"];
        $Cantidad_Prod = $_POST["Cantidad_Prod"];
        $Valor_Prod = $_POST["Valor_Prod"];

        $Update_Prod_sql = "UPDATE `base_bar`.`inventario` SET `Nombre_producto` = '$Nombre_Prod', `Cantidad_Uni` = '$Cantidad_Prod', `Valor_unidad` = '$Valor_Prod' WHERE (`idProductos` = '$id_Prod_update');";
        $Exec_Update_Prod_sql = mysqli_query($conexion, $Update_Prod_sql);

        if ($Exec_Update_Prod_sql) {
            $_SESSION['status'] = "Datos actualizados correctamente";
            header('location: http://localhost/Bar/Paginas/Administrador/productos.php');
        }else{
            $_SESSION['status'] = "La actualización de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Administrador/productos.php');
        }
    }

?>