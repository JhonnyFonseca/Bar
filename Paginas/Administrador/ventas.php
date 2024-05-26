<?php
session_start();
if (empty($_SESSION["idUsuarios"])) {
    header("location:../../login.php");
}

require "../../Modelo/conexion.php";

$sql_filtrar_ventas = "SELECT idVentas_Temp, Cantidad, Valor_total, Fecha_venta, Nombre_sede, Nombre_producto, Mesa_venta, Metodo_pago FROM base_bar.ventas_totales";
$Ventas = mysqli_query($conexion, $sql_filtrar_ventas);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrador - Ventas</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800">Ventas</h1>
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
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Ventas actuales</h4>
                                </div>
                                <div class="card-body">
                                <table id="example" class="display table table-striped nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sede de la venta</th>
                                            <th>Fecha de la venta</th>
                                            <th>Porducto vendido</th>
                                            <th>Cantidad</th>
                                            <th>Valor total</th>
                                            <th>Mesa de la venta</th>
                                            <th>Metodo de pago</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($Ventas)) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row["Nombre_sede"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["Fecha_venta"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["Nombre_producto"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["Cantidad"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["Valor_total"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["Mesa_venta"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["Metodo_pago"]; ?>
                                                </td>
                                            </tr>
                                        <?php }; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Valor total</th>
                                            <th>Fecha de la venta</th>
                                            <th>Sede de la venta</th>
                                            <th>Porducto vendido</th>
                                            <th>Mesa de la venta</th>
                                            <th>Metodo de pago</th>
                                        </tr>
                                    </tfoot>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function (){
            $('.editbtn').on('click', function() {
                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text().trim();
                }).get();

                console.log(data);
                $('#Id_update_usu').val(data[0]);
                $('#Nombre_usuario').val(data[1]);
                $('#Apellido_usuario').val(data[2]);
                $('#Rol_usuario').val(data[3]);
                $('#Celular_usuario').val(data[4]);
                $('#Sede_usuario').val(data[5]);
                
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

                console.log(data);
                $('#Delete_Id_update').val(data[0]);
                $('#Delete_Nombre_usu').val(data[1]);
                $('#Delete_Apellido_usuario').val(data[2]);
                $('#Delete_Rol_usuario').val(data[3]);
                $('#Delete_Celular_usuario').val(data[4]);
                $('#Delete_Sede_usuario').val(data[5]);
            }) 
        })

</script>

<script>
new DataTable('#example', {
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-primary'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary'
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary'
                }
            ]
        }
    }
});
</script>

<script>
$(document).ready(function (){
        $('#example').DataTable({
            language: 
            'search':"Buscar:";
        });
    });
</script>


<script>
var contrasenaInput = document.getElementById("Contrasena_usuario");

// Agregar un event listener para escuchar los cambios en el campo de contraseña
contrasenaInput.addEventListener("input", function() {
    // Obtener el valor del campo de contraseña
    var contrasena = contrasenaInput.value;
    
    // Verificar si la contraseña tiene al menos 6 caracteres
    if (contrasena.length < 6) {
        // Si la contraseña no cumple con el requisito, mostrar un mensaje de error
        contrasenaInput.setCustomValidity("La contraseña debe tener al menos 6 caracteres.");
    } else {
        // Si la contraseña cumple con el requisito, borrar cualquier mensaje de error previo
        contrasenaInput.setCustomValidity("");
    }
});
</script>

<script>
var celularInput1 = document.getElementById("Celular_usuario1");

// Agregar un event listener para escuchar los cambios en el campo de contraseña
celularInput1.addEventListener("input", function() {
    // Obtener el valor del campo de contraseña
    var celular1 = celularInput1.value;
    
    // Verificar si la contraseña tiene al menos 6 caracteres
    if (celular1.length < 10) {
        // Si la contraseña no cumple con el requisito, mostrar un mensaje de error
        celularInput1.setCustomValidity("El numero de celular debe tener al menos 10 caracteres.");
    } else {
        // Si la contraseña cumple con el requisito, borrar cualquier mensaje de error previo
        celularInput1.setCustomValidity("");
    }
});

var celularInput = document.getElementById("Celular_usuario");

// Agregar un event listener para escuchar los cambios en el campo de contraseña
celularInput.addEventListener("input", function() {
    // Obtener el valor del campo de contraseña
    var celular = celularInput.value;
    
    // Verificar si la contraseña tiene al menos 6 caracteres
    if (celular.length < 10) {
        // Si la contraseña no cumple con el requisito, mostrar un mensaje de error
        celularInput.setCustomValidity("El numero de celular debe tener al menos 10 caracteres.");
    } else {
        // Si la contraseña cumple con el requisito, borrar cualquier mensaje de error previo
        celularInput.setCustomValidity("");
    }
});
</script>

</body>

</html>