<!DOCTYPE html>
<?php include 'C:\Git\GitHub\ProyectoOriginal\ProyectoWeb-main\ProyectoWeb-main\ProyectoOriginal\config\database.php';


//Verificamos si el usuario y contraseña trae información
if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
  //Se reciben los valores del formulario en variables
  $usuario = $_POST['usuario'];
  $pass = $_POST['contraseña'];
  //Realizar consulta a base de datos
  $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' and contraseña = '$pass'";
  //Se ejecuta la consulta
  $resultado = $conn->query($sql);
  //Condicional por si encuentra registro
  if ($resultado->num_rows  == 1) {
    session_start();
    $row = $resultado->fetch_assoc();
    //Se crea variable de sesion
    $_SESSION['user'] = $row['nombre'];
    //Se redirecciona al INDEX
    header("Location:index.php");
    die();
  } else {
    echo '<div class = "alert alert-danger" role = "alert"> Usuario o Contraseña incorrectos.</div>';
}}
  
?>
<html data-bs-theme="light" lang="en">
  

  
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>Administrador</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=ADLaM+Display&amp;display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Alef&amp;display=swap"
    />
    <link rel="stylesheet" href="../assets/fonts/ionicons.min.css" />
    <link rel="stylesheet" href="../assets/css/bs-theme-overrides.css" />
    <link rel="stylesheet" href="../assets/css/Checkbox-Input.css" />
    <link rel="stylesheet" href="../assets/css/Features-Cards-icons.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
    />
    <link
      rel="stylesheet"
      href="../assets/css/Table-with-Search--Sort-Filters-v20.css"
    />
    <link rel="stylesheet" href="../assets/css/untitled.css" />
  </head>

  <body>
    <div
      class="container d-flex justify-content-center align-items-center"
      style="width: 700px; height: 500px"
    >
      <div class="card shadow p-4" style="width: 300px">
        <i class="icon ion-person" style="width: 23.4px"></i>
        <h3
          class="text-center"
          style="font-family: 'ADLaM Display', serif; color: rgb(0, 0, 0)"
        >
          Iniciar Sesión
        </h3>
        <form method="post">
          <div class="mb-3">
            <label
              class="form-label"
              style="font-family: 'ADLaM Display', serif; color: rgb(0, 0, 0)"
              >Usuario</label
            ><input
              class="form-control form-control"
             
              name="usuario"
              type="text"
            />
            <div id="errorUsuario" class="text-danger"></div>
          </div>
          <div class="mb-3">
            <label
              class="form-label"
              style="font-family: 'ADLaM Display', serif; color: rgb(0, 0, 0)"
              >Contraseña</label
            ><input
              class="form-control form-control"
              
              name="contraseña"
              type="password"
            />
            <div id="errorContraseña" class="text-danger"></div>
          </div>
          <div class="mb-3 form-check">
            <input
              type="checkbox"
              class="form-check-input"
              id="showPasswords"
              onclick="togglePasswords()"
            />
            <label
              class="form-check-label"
              for="showPasswords"
              style="color: rgb(0, 0, 0)"
              >Mostrar Contraseña</label
            >
          </div>
          <button
            class="btn btn-primary w-100"
            type="submit"
            id="loginButton"
            style="
              color: var(--bs-light);
              background: var(--bs-info);
              font-weight: bold;
            "
          >
            Ingresar
          </button>
          <div
            class="d-flex justify-content-start"
            style="width: auto; height: auto"
          >
            <a
              class="btn btn-primary"
              role="button"
              style="background: var(--bs-info); font-weight: bold"
              href="../../Views/Paginas Principales/index_prin.php"
              ><i class="icon ion-android-arrow-back"></i
            ></a>
          </div>
        </form>
      </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="../assets/js/TableZoomSorter.js"></script>
    <script src="../assets/js/Tema_Admin.js"></script>
    <script src="../assets/js/WaveClickFX.js"></script>
    <script src="../JS/validar_logjn.js"></script>
  </body>
</html>
