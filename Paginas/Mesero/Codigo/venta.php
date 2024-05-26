<?php
    session_start();
    if (empty($_SESSION["idUsuarios"])) {
        header("location:../../../login.php");
    }

    require "../../../Modelo/conexion.php";
    $sede= $_SESSION["Usuario_Sede"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ids = $_POST['idProductos'];
    $cantidades = $_POST['Cantidad_Uni'];
    $inventario = $_POST['Cantidad_act'];
    $valor_unidad = $_POST['valorProductos'];
    $unidad_venta = $_POST['unidad_venta'];
    $id_venta = $_POST['id_venta'];
    $mesa = $_POST['mesa'];
    $Valor_total = $_POST['valor_total'];
    $insertorupdate = 0;

    $sql_filtrar_venta ="SELECT cantidad FROM base_bar.ventas 
                        WHERE id_sede = '$sede' 
                        AND Mesa_venta = '$mesa' 
                        AND Estado_venta = '0'";

    $resultado = $conexion->query($sql_filtrar_venta);

    $Venta_of = $resultado->fetch_assoc();

    // Verificar si `cantidad` está presente y no es nulo, de lo contrario asignar `0`
    $cantidad = isset($Venta_of["cantidad"]) ? $Venta_of["cantidad"] : 0;

    for ($i = 0; $i < count($ids); $i++) {
        $venta_actual = $unidad_venta[$i];

        echo $venta_actual;

        if($venta_actual != 0){
            $insertorupdate = 1;
        }
    }

    if($cantidad == 0 && $insertorupdate == 0){
        // validar que las cantidades no esten vacias
        $condicion = 0;
        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $cantidad1 = $cantidades[$i];
            $val_unidad = $valor_unidad[$i];
            $inv_actual = $inventario[$i];

            if ($cantidad1 != 0){
                $condicion = 1; 
            }
        }
        //si no esta vacio empieza a ingresar los datos a las ventas
            if($condicion == 1){
                
                $cant_condicion =  0;
                for ($i = 0; $i < count($ids); $i++) {
                    $id = $ids[$i];
                    $cantidad = $cantidades[$i];
                    $val_unidad = $valor_unidad[$i];
                    $inventarioact = $inventario[$i];
                    $unidad_act = $unidad_venta[$i];

                    $nuevacantidad = $inventarioact-$cantidad;

                    if ($nuevacantidad >= 0) {
                        echo "bien";                    
                    }else{
                        $cant_condicion = 1;
                    }

                    if  ($cant_condicion == 1){
                        $_SESSION['status'] = "No hay unidades suficientes del producto solicitado";
                        header('location: http://localhost/Bar/Paginas/Mesero/gestion_mesas.php');
                    }else{
                        //ecuaciones de ingreso de ventas
                        $sql_estado_mesa ="UPDATE `base_bar`.`mesas` SET `Estado` = '1' WHERE (`idMesas` = '$mesa')";
                        if(mysqli_query($conexion, $sql_estado_mesa)){
                            echo "mesa actualizada";
                        }
                        $valortotal = $val_unidad * $cantidad;
                        $nuevacantidad = $inventarioact-$cantidad;
                        $unidadvendida = $unidad_act + $cantidad;
                        $sql_actualizar_inv ="UPDATE `base_bar`.`inventario` SET `Cantidad_Uni` = '$nuevacantidad' WHERE (`idProductos` = '$id')";
                        if(mysqli_query($conexion, $sql_actualizar_inv)){
                            echo "inventario actualizado";
                        }
                        
                        $sql_actualizar_venta ="INSERT INTO `base_bar`.`ventas` (`Cantidad`, `Valor_total`, `Fecha_Venta`, `Id_producto_inv`, `Id_sede`, `Mesa_venta`, `Estado_venta`) 
                        VALUES ('$cantidad', '$valortotal', NOW(), '$id', '$sede', '$mesa', '0')";
                        if(mysqli_query($conexion, $sql_actualizar_venta)){
                            echo "venta registrada";
                        }

                        $_SESSION['status'] = "Venta registrada";
                        header('location: http://localhost/Bar/Paginas/Mesero/gestion_mesas.php');  
                    }
                }
            }else{
                $_SESSION['status'] = "Las cantidades a asignar estan vacias";
                header('location: http://localhost/Bar/Paginas/Mesero/gestion_mesas.php');
            }
    }else{
        $condicion = 0;
        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $cantidad1 = $cantidades[$i];
            $val_unidad = $valor_unidad[$i];
            $inv_actual = $inventario[$i];

            if ($cantidad1 != 0){
                $condicion = 1; 
            }
        }
        //si no esta vacio empieza a ingresar los datos a las ventas
            if($condicion == 1){
            $cant_condicion =  0;
                for ($i = 0; $i < count($ids); $i++) {
                    $id = $ids[$i];
                    $cantidad = $cantidades[$i];
                    $val_unidad = $valor_unidad[$i];
                    $inventarioact = $inventario[$i];
                    $unidad_act = $unidad_venta[$i];
                    $venta_id = $id_venta[$i];
                    $valortotal = $Valor_total[$i];

                    $nuevacantidad = $inventarioact-$cantidad;

                    if ($nuevacantidad >= 0) {
                        echo "bien";                    
                    }else{
                        $cant_condicion = 1;
                    }

                    if  ($cant_condicion == 1){
                        $_SESSION['status'] = "No hay unidades suficientes del producto solicitado";
                        header('location: http://localhost/Bar/Paginas/Mesero/gestion_mesas.php');
                    }else{
                        //ecuaciones de ingreso de ventas
                        $Venta_actual = $valortotal+($val_unidad * $cantidad);
                        $nuevacantidad = $inventarioact-$cantidad;
                        $unidadvendida = $unidad_act + $cantidad;

                        $sql_actualizar_inv ="UPDATE `base_bar`.`inventario` SET `Cantidad_Uni` = '$nuevacantidad' WHERE (`idProductos` = '$id')";
                        if(mysqli_query($conexion, $sql_actualizar_inv)){
                            echo "inventario actualizado";
                        }

                        $sql_actualizar_ven ="UPDATE `base_bar`.`ventas` SET `Cantidad` = '$unidadvendida', `Valor_total` = '$Venta_actual' WHERE (`idVentas_Temp` = '$venta_id')";
                        if(mysqli_query($conexion, $sql_actualizar_ven)){
                            echo "venta hecha";
                        }

                        $_SESSION['status'] = "Venta actualizada";
                        header('location: http://localhost/Bar/Paginas/Mesero/gestion_mesas.php'); 
                    }
                }
                }else{
                $_SESSION['status'] = "Las cantidades a asignar estan vacias";
                header('location: http://localhost/Bar/Paginas/Mesero/gestion_mesas.php');
            }
            }
        }else{
            $_SESSION['status'] = "Las cantidades a asignar estan vacias";
            header('location: http://localhost/Bar/Paginas/Mesero/gestion_mesas.php');
        }
?>