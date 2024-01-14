<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>CRUD DB Empledos</title>
  <!-- <link rel="icon" type="image/x-icon" href="dist/img//favicon.ico"> -->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/styles.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link href="plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" />
  <link rel="stylesheet" href="plugins/datatables/select.dataTables.min.css">



</head>

<body>
  <?php require_once '../models/IndexModel.php'; ?>

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

  <div class="container">
    <!-- Content Header -->
    <div class="mb-5 mt-5 p-5 titulo text-white text-center">
      <h1 class="m-0 text-center text-uppercase">Registros</h1>
    </div>

    <section class="content">
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table row-bordered table table-striped table-hover dataTable" id="dataTable" width="100%"
              cellspacing="0" style="white-space: nowrap; overflow-x: auto;">
              <thead>
                <tr class="bg-info">
                  <th scope="col">Nombre</th>
                  <th scope="col">Genero</th>
                  <th scope="col">Fecha de nacimiento</th>
                  <th scope="col">País</th>
                  <th scope="col">Email</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $model = new RegistroController();
                $result = $model->SelectRegistros();
                foreach ($result as $row) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $row['first_name'].' '.$row['last_name'] ?>
                    </td>
                    <td>
                      <?php echo $row['nombre_genero'] ?>
                    </td>
                    <td>
                      <?php echo $row['birthdate'] ?>
                    </td>
                    <td>
                      <?php echo $row['nombre_pais'] ?>
                    </td>
                    <td>
                      <?php echo $row['email'] ?>
                    </td>
                    <td>
                      <?php echo $row['phone'] ?>
                    </td>
                    <td>
                      <form action="consultar.php" method="post" class="btn">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button class="btn btn-warning"><i class="fas fa-pen fa-1x"></i></button>
                      </form>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="eliminar('<?php echo $row['id']; ?>', '<?php echo $row['first_name']; ?>', '<?php echo $row['last_name']; ?>')">
                        <i class="fas fa-trash fa-1x"></i>
                      </button>
                     
                    </td>
                  <?php } ?>
                </tr>
              </tbody>
              <tfoot>
                <tr class="bg-info">
                  <th scope="col">Nombre</th>
                  <th scope="col">Genero</th>
                  <th scope="col">Fecha de nacimiento</th>
                  <th scope="col">País</th>
                  <th scope="col">Email</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Acciones</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>


  <!-- Modal para eliminación de registro -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="Confirmareliminación" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Confirmareliminación">Confirmar eliminación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <p id="registro"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <form id="form-del">
            <input type="hidden" id="id-person" name="id" value="0">
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn-ok">Aceptar</button>
          </form>
        </div>
      </div>
    </div>
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
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables -->
  <script src="plugins/datatables/datatables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables/dataTables.select.min.js"></script>
  <script src="plugins/datatables/datatables-ini.js"></script>
  <script src="plugins/toastr/toastr.min.js"></script>
  <script src="dist/js/actions.js"></script>

</body>

</html>