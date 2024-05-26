<?php
session_start();
if (empty($_SESSION["idUsuarios"])) {
    header("location:../../login.php");
}

require "../../Modelo/conexion.php";

if(isset($_GET["idSedes"]) && !empty($_GET["idSedes"])) {
    $_SESSION["sedeGest"] = $_GET["idSedes"];
}

$sedeuni = $_SESSION["sedeGest"];

$sql_filtrar_sedes_mesa = "SELECT Nombre FROM base_bar.sedes where idSedes = '$sedeuni'";
$SedesMesa = mysqli_query($conexion, $sql_filtrar_sedes_mesa);
$Sede_of = mysqli_fetch_array($SedesMesa);

$sql_filtrar_mesa_sede = "SELECT idMesas,Numero_mesa,Estado,Mesa_Sedes FROM base_bar.mesas where Mesa_Sedes = '$sedeuni'";
$MesaSede = mysqli_query($conexion, $sql_filtrar_mesa_sede);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrador - Mesas</title>

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
                        <a class="collapse-item" href="ventas.php"> <i class="fas fa-solid fa-file"></i> Ventas</a>
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
                                    echo $_SESSION["Nombre"] . " " . $_SESSION["Apellido"];
                                    ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
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
                        <h1 class="h3 mb-0 text-gray-800">Mesas de la sede <?php echo $Sede_of["Nombre"];?></h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row justify-content-center">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">
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
                            <!-- Project Card Example -->
                            <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-end">
                                <h4>Mesas actuales</h4>
                                <div class="ml-auto">
                                    <form action="Codigo/insertar.php" method="GET" style="display: inline;">
                                        <input type="hidden" name="idmesa" value="<?php echo $sedeuni;?>">
                                        <button type="submit" name="Nueva_mesa" class="btn btn-primary btn-sm">Nueva mesa</button>
                                    </form>
                                    <form action="Codigo/eliminar.php" method="GET" style="display: inline;">
                                        <button type="button" name="Eliminar_ultima_mesa" class="btn btn-danger btn-sm deletebtn">Eliminar mesa</button>
                                    </form>
                                </div>
                            </div>
                                <div class="card-body">
                                    <table class="table table-striped table-bordered justify-content-center">
                                        <thead>
                                            <tr>
                                                <th>Id de la mesa
                                                </th>
                                                <th>Numero de la mesa
                                                </th>
                                                <th>Estado de la mesa
                                                </th>
                                                <th>Gestionar mesas
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_array($MesaSede)) { ?>
                                                <tr>
                                                    <td type="hidden">
                                                        <?php echo $row["idMesas"];?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["Numero_mesa"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($row["Estado"] == 0){
                                                            echo "Disponible";
                                                        } elseif($row["Estado"] == 1){
                                                            echo  "Ocupada";
                                                        } elseif($row["Estado"] == 2){
                                                            echo "Inhabilitada";
                                                        }   ?>
                                                    </td>
                                                    <td>
                                                        <button type ="button" class="btn btn-success btn-sm editbtn">Gestionar</a>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

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

    <div style="margin-top: 20px;"></div>

    <!-- Modal edit mesas -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodalLabel">Editar Mesa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <form action="Codigo/actualizar.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label for="">Id de la mesa</label>
                            <input type="number" name="Id_update_Mesa" id="Id_update_Mesa" class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Numero de la mesa</label>
                            <input type="text" name="Numero_mesa" id="Numero_mesa" class="form-control" placeholder="Nombre" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Estado de la mesa</label>
                            <select class="custom-select" name="Estado_mesa">
                                <option selected>seleccionar...</option>
                                <option value= "0">Disponible</option>
                                <option value= "1">Ocupada</option>
                                <option value= "2">Inhabilitada</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="Cambiar_Mesa" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div style="margin-top: 20px;"></div>

    <!-- Delete edit sede -->
    <div class="modal fade" id="deletebtn" tabindex="-1" role="dialog" aria-labelledby="deletebtnLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletebtnLabel">Editar sede</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <form action="Codigo/eliminar.php" method="GET">
                    <div class="modal-body">
                        <h5>¿Seguro que deseas eliminar la ultima mesa resgistrada?</h5>
                        <div class="form-group mb-3">
                            <input type="hidden" name="idmesa" value="<?php echo $sedeuni;?>">
                        </div>
                        <p>Este cambio es irreversible y se borrarán todos los datos dela ultima mesa registrada.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" name="Borrar_mesa" class="btn btn-primary">Si</button>
                    </div>
                </form>
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

    <script>
        $(document).ready(function (){
            $('.editbtn').on('click', function() {
                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text().trim();
                }).get();

                console.log(data);
                $('#Id_update_Mesa').val(data[0]);
                $('#Numero_mesa').val(data[1]);
            })
        })

    </script>

    <script>
        $(document).ready(function (){
            $('.deletebtn').on('click', function() {
                $('#deletebtn').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text().trim();
                }).get();
            }) 
        })

</script>
</body>

</html>