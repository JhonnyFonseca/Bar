<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/Login.css">
  </head>
  <body>
    <br/><br/><br/><br/><br/>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="card " style="width: 18rem;">
            <img src="Imagen/Logo.webp" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Inicio de sesión</h5>
              <?php
                include "Modelo/inicio.php";
              ?>
            </div>
            <form method="POST">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <label for="usuario" class="form-label">Identificación :</label>
                  <input type="number" class="form-control" name="usuario" required/>
                </li>
                <li class="list-group-item">
                  <label for="password" class="form-label">Contraseña :</label>
                  <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" required/>
                    <span class="input-group-text"><i class='bx bx-low-vision'></i></span>
                  </div>
                </li>
                <li class="list-group-item">
                  <input name="btningresar" type="submit" class="btn btn-primary mb-3" value="Ingresar"/>
                </li>
              </ul>
            </form>
          </div>
      </div>
    </div>
    
    <script src ="Scripts/Login.js"></script>
  </body>
</html>