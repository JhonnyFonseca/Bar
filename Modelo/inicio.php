<?php

require "conexion.php";

session_start();
if($_POST){
    $userid = $_POST['usuario'];
    $password = $_POST['password'];

    $sql ="SELECT IdUsuario, Contrasena FROM base_bar.login where IdUsuario ='$userid' and Contrasena ='$password'";
    $resultado = mysqli_query($conexion, $sql);
    $num_registros = mysqli_num_rows($resultado);

    if($num_registros != 0){
        $sql_rol  ="SELECT Rol, idUsuarios, Nombre, Apellido, Usuario_Sede FROM base_bar.usuarios where idUsuarios = '$userid'";
        $rol = mysqli_query($conexion, $sql_rol);
        $filas = mysqli_fetch_array($rol);

        $_SESSION["idUsuarios"] = $filas['idUsuarios'];
        $_SESSION["Nombre"] = $filas ['Nombre'];
        $_SESSION["Apellido"] = $filas ['Apellido'];
        $_SESSION["Usuario_Sede"] = $filas ['Usuario_Sede'];

        $numsede =$filas['Usuario_Sede'];

        $sql_sede ="SELECT Nombre FROM base_bar.sedes where idSedes ='$numsede'";
        $sede = mysqli_query($conexion, $sql_sede);
        $nomsede = mysqli_fetch_array($sede);

        $_SESSION["NombreSede"] = $nomsede['Nombre'];

        if ($filas['Rol']==1){
            header('location: http://localhost/Bar/Paginas/Administrador/main.php');
        }
        elseif ($filas['Rol']==2){
            header('location: http://localhost/Bar/Paginas/Mesero/main.php');
        }
        elseif ($filas['Rol']==3){
            header('location: http://localhost/Bar/Paginas/Cajero/main.php');
        }
    }else{
        echo "<div class = 'alert alert-danger'>Usuario y/o contraseña incorrectos</div>";
    }
}
?>