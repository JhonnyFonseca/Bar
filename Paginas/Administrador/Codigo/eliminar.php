<?php
    session_start();
    if (empty($_SESSION["idUsuarios"])) {
        header("location:../../../login.php");
    }

    if (isset($_POST["Borrar_sede"])) {
        require "../../../Modelo/conexion.php";
        
        $Delete_Id_update = $_POST["Delete_Id_update"];

        $Delete_sede_sql = "CALL BorrarSedes('$Delete_Id_update')";
        $Exec_Delete_sede_sql = mysqli_query($conexion, $Delete_sede_sql);
        if ($Exec_Delete_sede_sql) {
            $_SESSION['status'] = "Datos eliminados correctamente";
            header('location: http://localhost/Bar/Paginas/Administrador/sedes.php');
        }else{
            $_SESSION['status'] = "La eliminación de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Administrador/sedes.php');
        }
    }

    if (isset($_POST["Borrar_usuario"])) {
        require "../../../Modelo/conexion.php";
        
        $Delete_Id_update = $_POST["Delete_Id_update"];

        $Delete_usuario_sql = "CALL BorrarUsuario('$Delete_Id_update')";
        $Exec_Delete_usuario_sql = mysqli_query($conexion, $Delete_usuario_sql);
        if ($Exec_Delete_usuario_sql) {
            $_SESSION['status'] = "Datos eliminados correctamente";
            header('location: http://localhost/Bar/Paginas/Administrador/usuarios.php');
        }else{
            $_SESSION['status'] = "La eliminación de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Administrador/usuarios.php');
        }
    }

    if (isset($_GET["Borrar_mesa"])) {
        require "../../../Modelo/conexion.php";

        $eliminarmesa_sede = $_GET["idmesa"];

        $sql_mesa_max = "SELECT max(Numero_mesa) as ultimamesa FROM base_bar.mesas where Mesa_sedes = '$eliminarmesa_sede'";
        $Execmesamax = mysqli_query($conexion, $sql_mesa_max);
        $MesaMax = mysqli_fetch_array($Execmesamax);

        $Eliminarmesa = $MesaMax["ultimamesa"];

        $sql_delete_mesa = "DELETE FROM `base_bar`.`Mesas` WHERE Mesa_Sedes = '$eliminarmesa_sede' && Numero_mesa = '$Eliminarmesa'";
        $ExecdeleteMesa = mysqli_query($conexion, $sql_delete_mesa);

        if ($ExecdeleteMesa) {
            $_SESSION['status'] = "Datos eliminados correctamente";
            header('location: http://localhost/Bar/Paginas/Administrador/mesas.php');
        }else{
            $_SESSION['status'] = "La eliminación de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Administrador/mesas.php');
        }
    }

    if (isset($_POST["Borrar_producto"])) {
        require "../../../Modelo/conexion.php";

        $Delete_Id_update_prod = $_POST["Delete_Id_update_prod"];

        $sql_delete_prod = "DELETE FROM `base_bar`.`inventario` WHERE idProductos = '$Delete_Id_update_prod';";
        $Execdeleteprod = mysqli_query($conexion, $sql_delete_prod);

        if ($Execdeleteprod) {
            $_SESSION['status'] = "Datos eliminados correctamente";
            header('location: http://localhost/Bar/Paginas/Administrador/productos.php');
        }else{
            $_SESSION['status'] = "La eliminación de datos presentaron fallas, por favor intentelo nuevamente";
            header('location: http://localhost/Bar/Paginas/Administrador/productos.php');
        }
    }

?>