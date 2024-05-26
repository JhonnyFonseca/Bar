<?php

$conexion = new mysqli("localhost","root","","base_bar");
$conexion->set_charset("utf8");

//si falla la conexión
if (!$conexion){
    die("Conexión fallida: ".mysqli_connect_error());
}

?>