<?php
session_start();
if(empty($_SESSION["idUsuarios"])){
  header("location:../../login.php");
}

require "../../Modelo/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrador - Main</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .d-item{
            height:610px;
        }

        .d-img{
            height: 100%;
            object-fit: cover;
        }
    </style>   
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
                <div class="sidebar-brand-text mx-3">Administrador</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="main.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Menu</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administración
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Gestionar sedes</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="sedes.php"><i class="fas fa-regular fa-building"></i> Sedes</a>
                        <a class="collapse-item" href="usuarios.php"><i class="fas fa-solid fa-users"></i> Usuarios</a>
                        <a class="collapse-item" href="mesas_sedes.php"><i class="fas fa-solid fa-table"></i> Mesas</a>
                        <a class="collapse-item" href="ventas.php"><i class="fas fa-solid fa-file"></i> Ventas</a>
                        <a class="collapse-item" href="productos_sedes.php"><i class="fas fa-solid fa-warehouse"></i> Productos</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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
                                    ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuración
                                </a>
                                <div class="dropdown-divider"></div>
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Ventas realizadas diarias</div>
                                            <?php 
                                                $sql_vent_dia ="SELECT sum(Valor_total) as Ventasdiarias FROM base_bar.ventas_totales WHERE fecha_venta = CURDATE()";
                                                $Vent_diaria = mysqli_query($conexion, $sql_vent_dia);
                                                $ven = mysqli_fetch_array($Vent_diaria);
                                                $total_vent_dia = $ven['Ventasdiarias'];
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php if($total_vent_dia != 0) {echo $total_vent_dia;}else{echo "0";}?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Ventas realizadas total</div>
                                            <?php 
                                                $sql_vent_tot ="SELECT sum(Valor_total) as Ventasdiarias FROM base_bar.ventas_totales";
                                                $Vent_tot = mysqli_query($conexion, $sql_vent_tot);
                                                $vent = mysqli_fetch_array($Vent_tot);
                                                $total_vent_tot = $vent['Ventasdiarias'];
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php echo $total_vent_tot;?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sedes habilitadas
                                            </div>
                                            <?php 
                                                $sql_cant_sedes ="SELECT count(idSedes) as total_sedes FROM base_bar.sedes";
                                                $cant_sedes = mysqli_query($conexion, $sql_cant_sedes);
                                                $Sed = mysqli_fetch_array($cant_sedes);
                                                $total_sedes = $Sed['total_sedes'];
                                            ?>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $total_sedes;?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Cantidad total de empleados</div>
                                                <?php 
                                                    $sql_cant_emp ="SELECT count(idUsuarios) as total_empleados FROM base_bar.usuarios where rol <> '1'";
                                                    $cant_emp = mysqli_query($conexion, $sql_cant_emp);
                                                    $Emp = mysqli_fetch_array($cant_emp);
                                                    $total_Emp = $Emp['total_empleados'];
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_Emp;?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-regular fa-user text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-10">
                        <!-- Carousel -->
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active d-item">
                                        <img src="../../Imagen/Sede1.jpeg" class="d-block w-100 d-img" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <?php 
                                                    $sql_sede1="SELECT Nombre FROM base_bar.sedes where idSedes ='1'";
                                                    $sede1 = mysqli_query($conexion, $sql_sede1);
                                                    $sed1 = mysqli_fetch_array($sede1);
                                                    $Nomsede1 = $sed1['Nombre'];
                                                ?>
                                            <h5>Sede <?php echo $Nomsede1;?></h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item d-item">
                                        <img src="../../Imagen/Sede2.jpeg" class="d-block w-100 d-img" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                                <?php 
                                                    $sql_sede2="SELECT Nombre FROM base_bar.sedes where idSedes ='2'";
                                                    $sede2 = mysqli_query($conexion, $sql_sede2);
                                                    $sed2 = mysqli_fetch_array($sede2);
                                                    $Nomsede2 = $sed2['Nombre'];
                                                ?>
                                            <h5>Sede <?php echo $Nomsede2;?></h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item d-item">
                                        <img src="../../Imagen/Sede3.jpg" class="d-block w-100 d-img" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                                <?php 
                                                    $sql_sede3="SELECT Nombre FROM base_bar.sedes where idSedes ='3'";
                                                    $sede3 = mysqli_query($conexion, $sql_sede3);
                                                    $sed3 = mysqli_fetch_array($sede3);
                                                    $Nomsede3 = $sed3['Nombre'];
                                                ?>
                                            <h5>Sede <?php echo $Nomsede3;?></h5>
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </button>
                            </div>
                        </div>

                </div>
                <!-- /.container-fluid -->

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