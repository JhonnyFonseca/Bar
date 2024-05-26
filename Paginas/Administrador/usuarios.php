<?php
session_start();
if (empty($_SESSION["idUsuarios"])) {
    header("location:../../login.php");
}

require "../../Modelo/conexion.php";

$sql_filtrar_usuarios = "SELECT usu.idUsuarios as idUsuario ,usu.Nombre as Nombreusu, usu.Apellido as Apellidousu, rol.Rol as rol, Celular as celular,sed.Nombre as nombresed FROM base_bar.usuarios as usu inner join base_bar.rol as rol on usu.Rol = rol.idRol inner join base_bar.sedes as sed on usu.Usuario_Sede = sed.idSedes";
$Usarios = mysqli_query($conexion, $sql_filtrar_usuarios);

$sql_filtrar_sedes_temp = "SELECT idSedes, Nombre FROM base_bar.sedes";
$Sedes_temp = mysqli_query($conexion, $sql_filtrar_sedes_temp);

$sql_filtrar_rol_temp = "SELECT idRol, Rol FROM base_bar.rol where idRol <> '1'";
$rol_temp = mysqli_query($conexion, $sql_filtrar_rol_temp);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrador - Sedes</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
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
                                    <h4>Usuarios actuales</h4>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Insertuser">
                                        Agregar usuario
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-bordered justify-content-center">
                                        <thead>
                                            <tr>
                                                <th>Id del usuario
                                                </th>
                                                <th>Nombre del usuario
                                                </th>
                                                <th>Apellido del usuario
                                                </th>
                                                <th>Rol del usuario
                                                </th>
                                                <th>Numero de celular del usuario
                                                </th>
                                                <th>Sede del usuario
                                                </th>
                                                <th>Modificar
                                                </th>
                                                <th>Eliminar
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_array($Usarios)) { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row["idUsuario"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["Nombreusu"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["Apellidousu"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["rol"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["celular"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row["nombresed"]; ?>
                                                    </td>
                                                    <td>
                                                        <button type ="button" class="btn btn-success btn-sm editbtn">Modificar</a>
                                                    </td>
                                                    <td>
                                                        <button type ="button"  class="btn btn-danger btn-sm deletebtn">Eliminar</a>
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

    <!-- Modal insert sede -->
    <div class="modal fade" id="Insertuser" tabindex="-1" role="dialog" aria-labelledby="InsertuserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="InsertuserLabel">Insertar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <form action="Codigo/insertar.php" method="POST">
                    <div class="modal-body">
                        
                        <div class="form-group mb-3">
                            <label for=""># de identificación del usuario</label>
                            <input type="number" name="Id_usuario" class="form-control" placeholder="Identificación" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Nombre del usuario</label>
                            <input type="text" name="Nombre_usuario" class="form-control" placeholder="Nombre" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Apellido del usuario</label>
                            <input type="text" name="Apellido_usuario" class="form-control" placeholder="Apellido"required>
                        </div>

                        <div class="form-group mb-3">
                            <label for=""># de celular del usuario</label>
                            <input type="number" name="Celular_usuario1" id="Celular_usuario1" class="form-control" placeholder="Celular" required>
                            <small id="passwordHelp" class="form-text text-muted">El numero de celular debe tener al menos 10 caracteres.</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Sede del usuario</label>
                            <select class="custom-select" name="Sede_usuario">
                                <option selected>seleccionar...</option>
                                <?php while ($row1 = mysqli_fetch_array($Sedes_temp)) { ?>
                                    <option value= "<?php echo $row1["idSedes"];?>">
                                        <?php echo $row1["Nombre"];?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Rol del usuario</label>
                            <select class="custom-select" name="Rol_usuario">
                                <option selected>seleccionar...</option>
                                <?php while ($row2 = mysqli_fetch_array($rol_temp)) { ?>
                                    <option value= "<?php echo $row2["idRol"];?>">
                                        <?php echo $row2["Rol"];?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Contraseña del usuario</label>
                            <input type="text" name="Contrasena_usuario" id="Contrasena_usuario" class="form-control" placeholder="Contraseña" required>
                            <small id="passwordHelp" class="form-text text-muted">La contraseña debe tener al menos 6 caracteres.</small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="Guardar_usuario" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div style="margin-top: 20px;"></div>

    <!-- Modal edit sede -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodalLabel">Editar sede</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <form action="Codigo/actualizar.php" method="POST">
                    <div class="modal-body">

                    <div class="form-group mb-3">
                            <label for=""># de identificación del usuario</label>
                            <input type="number" name="Id_update_usu" id="Id_update_usu" class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Nombre del usuario</label>
                            <input type="text" name="Nombre_usuario" id="Nombre_usuario" class="form-control" placeholder="Nombre" >
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Apellido del usuario</label>
                            <input type="text" name="Apellido_usuario" id="Apellido_usuario" class="form-control" placeholder="Apellido">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Rol del usuario</label>
                            <input type="text" name="Rol_usuario" id="Rol_usuario" class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for=""># de celular del usuario</label>
                            <input type="number" name="Celular_usuario" id="Celular_usuario" class="form-control" placeholder="Celular">
                            <small id="CellphoneHelp" class="form-text text-muted">El numero de celular debe tener al menos 10 caracteres.</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Sede del usuario</label>
                            <input type="text" name="Sede_usuario" id="Sede_usuario" class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Contraseña del usuario</label>
                            <input type="text" name="Contrasena_usuario" id="Contrasena_usuario" class="form-control" placeholder="Contraseña" required>
                            <small id="passwordHelp" class="form-text text-muted">La contraseña debe tener al menos 6 caracteres.</small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="Cambiar_usuario" class="btn btn-primary">Actualizar</button>
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
                <form action="Codigo/eliminar.php" method="POST">
                    <div class="modal-body">
                        <h5>¿Seguro que deseas eliminar el siguiente usuario?</h5>
                        <div class="form-group mb-3">
                            <label for="">id del usuario</label>
                            <input type="number" name="Delete_Id_update" id="Delete_Id_update" class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Nombre del usuario</label>
                            <input type="text" name="Delete_Nombre_usu" id ="Delete_Nombre_usu" class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Apellido del usuario</label>
                            <input type="text" name="Delete_Apellido_usuario" id ="Delete_Apellido_usuario" class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Rol del usuario</label>
                            <input type="text" name="Delete_Rol_usuario" id ="Delete_Rol_usuario" class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Sede del usuario</label>
                            <input type="text" name="Delete_Sede_usuario" id ="Delete_Sede_usuario" class="form-control" readonly>
                        </div>

                        <p>Este cambio es irreversible y se borrarán todos los datos del usuario y inicio de sesión de todo el sistema.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" name="Borrar_usuario" class="btn btn-primary">Si</button>
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