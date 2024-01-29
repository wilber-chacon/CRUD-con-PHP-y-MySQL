<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>CRUD DB Empledos</title>
  <link rel="icon" type="image/x-icon" href="dist/img//logo.ico">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/styles.css">

  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.css">
  <!-- DataTables -->
  <link href="plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" />
  <link rel="stylesheet" href="plugins/datatables/select.dataTables.min.css">



</head>

<body>
  <?php require_once '../models/PersonaModel.php'; ?>


  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Wilber Chacón</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="agregar.php"><i class="fas fa-user-plus"></i> Agregar registro</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container shadow mb-5 pb-4">
    <!-- Content Header -->
    <div class="mb-5 mt-5 p-5 titulo text-white text-center">
      <h1 class="m-0 text-center text-uppercase">Detalles del registro</h1>
    </div>

    <section class="content">
      <div class=" container col-10 card mb-4">
        <div class="card-body">
          <form class="row g-3 mb-2" id="form-update">
            <?php
            $id = $_POST['id'];
            $model = new PersonaModel();
            $result = $model->consultarRegistro($id);
            foreach ($result as $row) {

              ?>
              <div class="input-group mb-4">
                <div class="input-group-text p-0 pl-3 pr-3 border-0" style="background: none;">
                  <span class="text-danger" id="basic-addon1"
                    style="font-weight: 900; padding-top: 5px; padding-bottom: 0px; font-size: 1.6rem;">*</span>
                  <span class="form-control-plaintext ml-3 border-none"> Los datos son requeridos</span>
                </div>
              </div>
              <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
              <div class="col-md-6">
                <label class="form-label"><span class="text-danger">*</span>Primer nombre</label>
                <input class="form-control" name="nombre" value="<?php echo $row['first_name'] ?>" type="text" required>
                <br>
              </div>
              <div class="col-md-6">
                <label class="form-label"><span class="text-danger">*</span>Primer apellido</label>
                <input class="form-control" value="<?php echo $row['last_name'] ?>" name="primer-apellido" type="text"
                  required>
                <br>
              </div>
              <div class="col-md-6">
                <label class="form-label">Correo electrónico</label>
                <input class="form-control" name="email" value="<?php echo $row['email'] ?>" type="email">
              </div>
              <div class="col-md-6">
                <label class="form-label"><span class="text-danger">*</span> Género</label>
                <select class="form-control" name="genero" id="genero" required>
                  <option selected value="<?php echo $row['id_genero'] ?>">
                    <?php echo $row['nombre_genero'] ?>
                  </option>
                  <option value="1">Femenino</option>
                  <option value="2">Masculino</option>
                </select>

              </div>
              <div class="col-md-4 mt-4">
                <label class="form-label">Teléfono</label>
                <input class="form-control" value="<?php echo $row['phone'] ?>" placeholder="(000) 00000000"
                  name="telefono" type="text">
              </div>
              <div class="col-md-4 mt-4">
                <label class="form-label"><span class="text-danger">*</span> Fecha de nacimiento</label>
                <input class="form-control" value="<?php echo $row['birthdate'] ?>" name="birthdate" type="date" required>
              </div>
              <div class="col-md-4 mt-4">
                <label class="form-label"><span class="text-danger">*</span> País de origen</label>
                <select class="form-control" name="pais" id="pais" required>
                  <option selected value="<?php echo $row['id_pais'] ?>">
                    <?php echo $row['nombre_pais'] ?>
                  </option>
                  <?php
                  require_once '../models/IndexModel.php';
                  $model = new RegistroController();
                  $result = $model->SelectPaises();
                  foreach ($result as $row2) {
                    ?>
                    <option value="<?php echo $row2['id_pais'] ?>">
                      <?php echo $row2['nombre_pais'] ?>
                    </option>

                  <?php } ?>

                </select>
              </div>

            <?php } ?>
            <div class="col-md-12 mt-5">
              <div class="row g-3 mb-2">
                <div class="col-md-6 mt-5">
                  <a href="index.php" style="display: block; margin: auto; width: 70%;"
                    class="btn btn-info">Regresar</a>
                </div>
                <div class="col-md-6 mt-5">
                  <button type="submit" id="btn-update" style="display: block; margin: auto; width: 70%;"
                    class="btn btn-success">Actualizar</button>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </section>
  </div>



  <footer class="main-footer text-center text-white bg-dark p-5">
    <strong>Copyright &copy;
      <?php
      $fecha = new DateTime();
      $fecha->setTimezone(new DateTimeZone('America/El_Salvador'));
      $date = $fecha->format("Y");
      print_r($date);
      ?> -
    </strong>
    Wilber Chacón.
  </footer>


  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script src="plugins/jQuery/jquery-3.6.4.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables -->
  <script src="plugins/datatables/datatables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables/dataTables.select.min.js"></script>
  <script src="plugins/datatables/datatables-ini.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.js"></script>
  <script src="dist/js/action.js"></script>

</body>

</html>