<?php
session_start();
if(empty($_SESSION["idUsuarios"])){
  header("location:../../login.php");
}

require "../../Modelo/conexion.php";
$sede= $_SESSION["Usuario_Sede"];

$sql_filtrar_mesa ="SELECT idMesas, Numero_mesa, Estado FROM base_bar.mesas where Mesa_Sedes = '$sede' and (Estado ='1' or Estado ='0')";
$mesas = mysqli_query($conexion, $sql_filtrar_mesa);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mesero - Main</title>

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
                <div class="sidebar-brand-text mx-3">Mesero</div>
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
                    <div class="row">
                        <div class="container px-4 text-center">
                            <div class="row gx-5">
                                <div class="col">
                                <div class="shadow p-3 mb-5 bg-body rounded bg-success text-white">Disponible</div>
                                </div>
                                <div class="col">
                                <div class="shadow p-3 mb-5 bg-body rounded bg-danger text-white">Ocupado</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <table class="table table-striped justify-content-center">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>
                                                Mesas
                                            </center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        while   ($row = mysqli_fetch_array($mesas)){
                                            $estado = $row["Estado"];
                                    ?>
                                    <tr>
                                        <td>
                                            <center> 
                                                    <?php if ($estado =="0") { ?>
                                                        <form action="gestion_mesas.php" method="GET">
                                                        <input type="hidden" name="idMesa" value="<?php echo $row['idMesas']; ?>">
                                                        <button type="submit" class="btn btn-success">
                                                            <p>
                                                                <i class="fas fa-solid fa-inbox"></i>
                                                            </p>
                                                            <p>
                                                                Mesa numero: <?php echo $row["Numero_mesa"]; ?>
                                                            </p>
                                                        </button>
                                                        </form>
                                                    <?php } else { ?>
                                                        <div class="d-grid gap-2">
                                                            <form action="gestion_mesas.php" method="GET">
                                                                <input type="hidden" name="idMesa" value="<?php echo $row['idMesas']; ?>">
                                                                <button type="submit" class="btn btn-danger">
                                                                    <p>
                                                                        <i class="fas fa-solid fa-inbox"></i>
                                                                    </p>
                                                                    <p>
                                                                        Mesa numero: <?php echo $row["Numero_mesa"]; ?>
                                                                    </p>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    <?php } ?>
                                                </form>
                                            </div>

                                            </center>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                        </table>
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