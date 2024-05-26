<?php
    session_start();
    if (empty($_SESSION["idUsuarios"])) {
        header("location:../../../login.php");
    }

    if (isset($_POST["Guardar_sede"])) {
        require "../../../Modelo/conexion.php";
        
        $Nombre_sede = $_POST["Nombre_sede"];
        $Direccion_sede = $_POST["Direccion_sede"];
        $Ciudad_sede = $_POST["Ciudad_sede"];
        $Numero_mesas = $_POST["Numero_mesas"];

        $Insert_sede_sql = "CALL InsertarSede('$Numero_mesas','$Nombre_sede', '$Direccion_sede', '$Ciudad_sede')";
        $Exec_Insert_sede_sql = mysqli_query($conexion, $Insert_sede_sql);

        if ($Exec_Insert_sede_sql) {
            $_SESSION['status'] = "Datos insertados correctamente";
            header('location: http://localhost/Bar/Paginas/Administrador/sedes.php');
        }else{
            $_SESSION['status'] = "La inserción de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Administrador/sedes.php');
        }
    }

    if (isset($_POST["Guardar_usuario"])) {
        require "../../../Modelo/conexion.php";
        
        $Id_usuario = $_POST["Id_usuario"];
        $Nombre_usuario = $_POST["Nombre_usuario"];
        $Apellido_usuario = $_POST["Apellido_usuario"];
        $Celular_usuario = $_POST["Celular_usuario1"];
        $Sede_usuario = $_POST["Sede_usuario"];
        $Rol_usuario = $_POST["Rol_usuario"];
        $Contrasena_usuario = $_POST["Contrasena_usuario"];

        $Insert_usuario_sql = "CALL InsertarUsuario('$Id_usuario', '$Nombre_usuario', '$Apellido_usuario', '$Celular_usuario', '$Sede_usuario', '$Rol_usuario', '$Contrasena_usuario')";
        $Exec_Insert_usuario_sql = mysqli_query($conexion, $Insert_usuario_sql);

        if ($Exec_Insert_usuario_sql) {
            $_SESSION['status'] = "Datos insertados correctamente";
            header('location: http://localhost/Bar/Paginas/Administrador/usuarios.php');
        }else{
            $_SESSION['status'] = "La inserción de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Administrador/usuarios.php');
        }
    }

    if (isset($_GET["Nueva_mesa"])) {
        require "../../../Modelo/conexion.php";
        $nuevamesa_sede = $_GET["idmesa"];

        $sql_mesa_max = "SELECT max(Numero_mesa) as mesanueva FROM base_bar.mesas where Mesa_sedes = '$nuevamesa_sede'";
        $Execmesamax = mysqli_query($conexion, $sql_mesa_max);
        $MesaMax = mysqli_fetch_array($Execmesamax);

        $Mesanueva = $MesaMax["mesanueva"] +1;

        $sql_insert_mesa = "INSERT INTO `base_bar`.`mesas` (`Numero_mesa`, `Mesa_Sedes`,`Estado`) VALUES ('$Mesanueva', '$nuevamesa_sede', '0')";
        $ExecInsertMesa = mysqli_query($conexion, $sql_insert_mesa);

        if ($ExecInsertMesa) {
            $_SESSION['status'] = "Datos insertados correctamente";
            header('location: http://localhost/Bar/Paginas/Administrador/mesas.php');
        }else{
            $_SESSION['status'] = "La inserción de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Administrador/mesas.php');
        }

    }

    if (isset($_POST["Guardar_producto"])) {
        require "../../../Modelo/conexion.php";
        
        $Nombre_producto = $_POST["Nombre_producto"];
        $Cantidad_producto = $_POST["Cantidad_producto"];
        $Valor_unitario = $_POST["Valor_unitario"];
        $id_sede_producto = $_POST["id_sede_producto"];

        $sql_insert_prod = "INSERT INTO `base_bar`.`inventario` (`Nombre_producto`, `Cantidad_Uni`, `Valor_unidad`, `Producto_Sede`) VALUES ('$Nombre_producto', '$Cantidad_producto', '$Valor_unitario', '$id_sede_producto')";
        $ExecInsertProd = mysqli_query($conexion, $sql_insert_prod);

        if ($ExecInsertProd) {
            $_SESSION['status'] = "Datos insertados correctamente";
            header('location: http://localhost/Bar/Paginas/Administrador/productos.php');
        }else{
            $_SESSION['status'] = "La inserción de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Administrador/productos.php');
        }

    }
?>