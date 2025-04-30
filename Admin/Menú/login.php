<?php
session_start();
include_once '../../config/database.php'; // Asegúrate de que crea una conexión MySQLi ($conn)

if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
    $usuario = $_POST['usuario'];
    $pass = $_POST['contraseña'];

    // Credenciales predeterminadas del administrador
    $admin_user = "admin@gmail.com";
    $admin_pass = "admin";

    // Verificar si son las credenciales del admin
    if ($usuario === $admin_user && $pass === $admin_pass) {
        $_SESSION['user'] = "Administrador";
        header("Location: index.php");
        exit();
    }

    try {
        // Preparar la consulta con MySQLi
        $sql = "SELECT * FROM usuarios WHERE usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario); // Vincular el parámetro
        $stmt->execute();

        // Obtener el resultado
        $resultado = $stmt->get_result();
        $usuarioData = $resultado->fetch_assoc();

        if ($usuarioData) {
            // Verificar la contraseña
            if (password_verify($pass, $usuarioData['contraseña'])) {
                $_SESSION['user'] = $usuarioData['nombre'];
                header("Location: index.php");
                exit();
            } else {
                echo '<div class="alert alert-danger">Credenciales incorrectas</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Credenciales incorrectas</div>';
        }
    } catch (Exception $e) {
        error_log("Error de login: " . $e->getMessage());
        echo '<div class="alert alert-danger">Error en el sistema</div>';
    }
}
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>Administrador</title>
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/bs-theme-overrides.css" />
  <link rel="stylesheet" href="../assets/css/Checkbox-Input.css" />
  <link rel="stylesheet" href="../assets/css/Features-Cards-icons.css" />
  <link rel="stylesheet" href="../assets/css/Table-with-Search--Sort-Filters-v20.css" />
  <link rel="stylesheet" href="../assets/css/untitled.css" />
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center" style="width: 700px; height: 500px">
    <div class="card shadow p-4" style="width: 300px">
      <i class="icon ion-person" style="width: 23.4px"></i>
      <h3 class="text-center" style="font-family: 'ADLaM Display', serif; color: rgb(0, 0, 0)">Iniciar Sesión</h3>
      <form id="loginForm" method="post">
        <div class="mb-3">
          <label class="form-label">Usuario</label>
          <input class="form-control" name="usuario" type="text" />
          <div id="errorUsuario" class="text-danger"></div>
        </div>
        <div class="mb-3">
          <label class="form-label">Contraseña</label>
          <input class="form-control" name="contraseña" type="password" />
          <div id="errorContraseña" class="text-danger"></div>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="showPasswords" onclick="togglePasswords()" />
          <label class="form-check-label" for="showPasswords">Mostrar Contraseña</label>
        </div>
        <button class="btn btn-primary w-100" type="submit" id="loginButton" style="background: var(--bs-info); font-weight: bold;">
          Ingresar
        </button>
        <div class="d-flex justify-content-start mt-2" style="height: 20px;" >
          <a class="btn btn-primary" style="background: var(--bs-info); font-weight: bold" href="../../Views/Paginas Principales/index_prin.php">
            <i class="icon ion-android-arrow-back" style="color: black;"></i>
          </a>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePasswords() {
      const passwordField = document.querySelector('input[name="contraseña"]');
      passwordField.type = passwordField.type === "password" ? "text" : "password";
    }
  </script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../JS/validar_logjn.js"></script>
</body>
</html>
