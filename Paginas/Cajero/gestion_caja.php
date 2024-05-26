<?php
session_start();
if(empty($_SESSION["idUsuarios"])){
  header("location:../../login.php");
}

require "../../Modelo/conexion.php";
$sede= $_SESSION["Usuario_Sede"];

if(isset($_GET["idMesa"]) && !empty($_GET["idMesa"])) {
    $_SESSION["MesaGest"] = $_GET["idMesa"];
}

$mesaUni = $_SESSION["MesaGest"];

$sql_filtrar_mesa ="SELECT idMesas, Numero_mesa, Estado FROM base_bar.mesas where idMesas = '$mesaUni'";
$mesas = mysqli_query($conexion, $sql_filtrar_mesa);
$Mesa_of = mysqli_fetch_array($mesas);

$sql_filtrar_prod ="SELECT idProductos, Nombre_producto, Cantidad_Uni, Valor_unidad FROM base_bar.inventario where Producto_Sede = '$sede'";
$productos = mysqli_query($conexion, $sql_filtrar_prod);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cajero - facturar</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="main.php">
                <!--<div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-light fa-user"></i>
                </div>-->
                <div class="sidebar-brand-text mx-3">Cajero</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="main.php">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Menu</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                Inventario
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="inventario.php"><i class="fas fa-solid fa-warehouse"></i><span> Gestión inventario</span></a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <?php 
                                echo $_SESSION["NombreSede"];
                            ?>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                        <?php 
                                            echo $_SESSION["Nombre"]." ". $_SESSION["Apellido"];
                                        ?>
                                    </span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                        if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Hey ¡</strong> <?php echo $_SESSION['status']; ?> <strong>!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            unset($_SESSION['status']);
                        }
                    ?>
                    <center>
                        <h3>Mesa número <?php echo $Mesa_of["Numero_mesa"]; ?></h3>
                    </center>
                    <div class="row justify-content-center">
                        <form action="Codigo/ingresar_venta.php" method="POST" class="col-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id del producto</th>
                                        <th>Nombre del producto</th>
                                        <th>Cantidad disponible</th>
                                        <th>Cantidad total asignada</th>
                                        <th>Valor total vendido</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($productos)) { ?>
                                        <tr>
                                            <td><?php echo $row["idProductos"]; ?></td>
                                            <td><?php echo $row["Nombre_producto"]; ?></td>
                                            <td><?php echo $row["Cantidad_Uni"]; ?></td>
                                            <td>
                                                <?php 
                                                $prod = $row["idProductos"];
                                                $sql_filtrar_cant = "SELECT idVentas_Temp, cantidad, valor_total FROM base_bar.ventas 
                                                                    WHERE id_sede = '$sede' 
                                                                    AND Mesa_venta = '$mesaUni' 
                                                                    AND Id_producto_inv = '$prod' 
                                                                    AND Estado_venta = '0'";
                                                $cantidad = mysqli_query($conexion, $sql_filtrar_cant);
                                                $total_prod = 0;
                                                $valor_total= 0;
                                                if ($cantidad && mysqli_num_rows($cantidad) > 0) {
                                                    $cantidad_of = mysqli_fetch_array($cantidad);
                                                    $total_prod = $cantidad_of['cantidad'];
                                                    $id_venta = $cantidad_of['idVentas_Temp'];
                                                    $valor_total = $cantidad_of['valor_total'];
                                                } ?>
                                                <?php echo $total_prod; ?>
                                            </td>
                                            <td><?php echo $valor_total; ?></td>
                                            <td>
                                                <input type="hidden" name="mesa" value="<?php echo $mesaUni; ?>">
                                                <input type="hidden" name="id_venta[]" value="<?php echo $id_venta;?>">
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Metodo de pago</label>
                                        <select class="custom-select" name="Metodo_pago" required>
                                            <option value="" disabled selected>Seleccionar...</option>
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Tarjeta">Tarjeta</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-primary">Facturar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas cerrar la sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../../Modelo/fin.php">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>