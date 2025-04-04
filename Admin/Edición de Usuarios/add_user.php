<?php
// Configuración de la conexión PDO
include 'C:\Users\PC\Documents\GitHub\ProyectoOriginal\config\database.php';
session_start();

try {
    // Crear conexión PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validar y limpiar datos
        $nombre = $_POST['nombre'] ?? '';
        $usuario = strtolower($_POST['usuario']); // Convertir a minúsculas
        $contraseña = $_POST['contraseña'] ?? '';
        $confirmacion = $_POST['contraseñaConf'] ?? ''; // Nota: Hay un error de tipeo aquí (contraseña vs contraseñaConf)

        // Validaciones
        $errores = [];
        if (empty($nombre))
            $errores[] = "El nombre es obligatorio";
        if (empty($usuario))
            $errores[] = "El usuario es obligatorio";
        if (empty($contraseña))
            $errores[] = "La contraseña es obligatoria";
        if ($contraseña !== $confirmacion)
            $errores[] = "Las contraseñas no coinciden";
        if (!empty($errores)) {
            header("Location: ?error=" . urlencode(implode(", ", $errores)));
            exit();
        }

        // Procesar imagen
        $imagen_nombre = '';
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $directorio = '../assets/img/avatars/';
            if (!file_exists($directorio)) {
                mkdir($directorio, 0777, true);
            }
            $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $imagen_nombre = uniqid() . '.' . $extension;

            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio . $imagen_nombre)) {
                header("Location: ?error=Error al subir la imagen");
                exit();
            }
        }

        // Insertar en BD usando PDO
        // Hash de la contraseña
        $hashed_password = password_hash($contraseña, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, usuario, contraseña, imagen) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $usuario, $hashed_password, $imagen_nombre]);

        if ($stmt && $stmt->rowCount() > 0) {
            // Redirigir a la página de usuario después de la modificación
            header("Location: ../Menú/user.php?success=Usuario modificado correctamente");
            exit();
        } else {
            $error = $stmt ? $stmt->errorInfo()[2] : "Error al ejecutar la consulta";
            header("Location: ?error=" . urlencode($error));
            exit();
        }
          }
      } catch(PDOException $e) {
          die("Error en la conexión o consulta: " . $e->getMessage());
      }
?>


<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>

  <script src="..\JS\validar_user.js" defer></script>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>Administrador</title>
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ADLaM+Display&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alef&amp;display=swap" />
  <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css" />
  <link rel="stylesheet" href="../assets/fonts/typicons.min.css" />
  <link rel="stylesheet" href="../assets/css/bs-theme-overrides.css" />
  <link rel="stylesheet" href="../assets/css/Checkbox-Input.css" />
  <link rel="stylesheet" href="../assets/css/Features-Cards-icons.css" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
  <link rel="stylesheet" href="../assets/css/Table-with-Search--Sort-Filters-v20.css" />
  <link rel="stylesheet" href="../assets/css/untitled.css" />
</head>

<body>
  <div id="wrapper">
    <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark"
      style="background: var(--bs-primary)">
      <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-satellite-dish" style="color: var(--bs-black)"></i>
          </div>
          <div class="sidebar-brand-text mx-3">
            <span style="color: var(--bs-black)">Administrador</span>
          </div>
        </a>
        <hr class="sidebar-divider my-0" />
        <ul class="navbar-nav text-light" id="accordionSidebar">
          <li class="nav-item">
            <a class="nav-link" href="../Menú/index.php"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-dashboard"
                style="color: rgb(0, 0, 0); font-size: 22.6px">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M13.45 11.55l2.05 -2.05"></path>
                <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path>
              </svg><span style="color: var(--bs-black)">Principal</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Menú/products.php"><i class="typcn typcn-shopping-cart"
                style="color: rgb(0, 0, 0); font-size: 22.6px"></i><span
                style="color: var(--bs-black)">Productos</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../categories.php"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-category"
                style="color: rgb(0, 0, 0); font-size: 22.6px">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 4h6v6h-6z"></path>
                <path d="M14 4h6v6h-6z"></path>
                <path d="M4 14h6v6h-6z"></path>
                <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
              </svg><span style="color: var(--bs-black)">Categorías</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Ofertas/view_produc.php"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-currency-dollar"
                style="color: rgb(0, 0, 0); font-size: 22.6px">
                <path
                  d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z">
                </path>
              </svg><span style="color: var(--bs-black)">Ofertas</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Menú/user.php"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-users"
                style="font-size: 22.6px; color: rgb(0, 0, 0)">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
              </svg><span style="color: var(--bs-black)">Usuarios</span></a>
          </li>
        </ul>
        <div class="text-center d-none d-md-inline">
          <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"
            style="background: var(--bs-info); color: var(--bs-light)"></button>
        </div>
      </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
      <nav class="navbar navbar-expand bg-white shadow mb-4 topbar">
        <div class="container-fluid">
          <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button">
            <i class="fas fa-bars"></i>
          </button>
          <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown no-arrow">
              <div class="nav-item dropdown no-arrow">
                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                    class="d-none d-lg-inline me-2 text-gray-600 small">Yesid Amalec</span><img
                    class="border rounded-circle img-profile" src="../assets/img/avatars/avatar1.jpeg" /></a>
                <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                  <a class="dropdown-item" href="../Menú/login.php"><i
                      class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Cerrar Sesión</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <div id="content">
        <div class="container d-flex justify-content-center align-items-center"
          style="max-width: 500px; margin: 40px auto">
          <div class="card shadow-sm p-4 w-100">
            <h2 class="text-center mb-4" style="color: #000; font-weight: bold">
              Agregar Nuevo Usuario
            </h2>

            <form method="POST" action="add_user.php" enctype="multipart/form-data" id="formulario">
              <!-- Campo Nombre -->
              <div class="mb-3">
                <label class="form-label" for="nombre" style="color: #000">Nombre:</label>
                <input class="form-control" type="text" id="nombre" name="nombre" required
                  oninput="this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]/g, '')"
                  placeholder="Ingrese el nombre completo">
                <div id="errorNombre" class="text-danger small mt-1"></div>
              </div>

              <!-- Campo Usuario/Email -->
              <div class="mb-3">
                <label class="form-label" for="usuario" style="color: #000">Usuario (Email):</label>
                <input class="form-control" type="email" required id="usuario" name="usuario"
                  placeholder="ejemplo@dominio.com">
                <div id="errorUsuario" class="text-danger small mt-1"></div>
              </div>

              <!-- Campo Contraseña -->
              <div class="mb-3 position-relative">
                <label class="form-label" for="contraseña" style="color: #000">Contraseña:</label>
                <input class="form-control" type="password" required id="contraseña" name="contraseña"
                  placeholder="Mínimo 8 caracteres">
                <div id="errorContraseña" class="text-danger small mt-1"></div>
              </div>

              <!-- Campo Confirmar Contraseña -->
              <div class="mb-3 position-relative">
                <label class="form-label" for="contraseñaConf" style="color: #000">Confirmar Contraseña:</label>
                <input class="form-control" type="password" required id="contraseñaConf" name="contraseñaConf"
                  placeholder="Repita la contraseña">
                <div id="errorContraseñaConf" class="text-danger small mt-1"></div>
              </div>

              <!-- Campo Imagen -->
              <div class="mb-3">
                <label class="form-label" for="imagen" style="color: #000">Imagen de Perfil:</label>
                <input class="form-control" type="file" id="imagen" name="imagen" accept="image/*">
                <div class="form-text">Formatos aceptados: JPG, PNG, WEBP (Max. 2MB)</div>
                <div id="errorImagen" class="text-danger small mt-1"></div>
              </div>

              <!-- Checkbox Mostrar Contraseñas -->
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="showPasswords">
                <label class="form-check-label" for="showPasswords" style="color: #000">Mostrar Contraseñas</label>
              </div>

              <!-- Botones -->
              <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="submit" class="btn btn-primary" id="agregar" href="../Menú/user.php" style="
              background: var(--bs-info);
              font-weight: bold;
              margin-top: 10px;">
                  Agregar Usuario
                </button>
                <a class="btn btn-secondary" href="../Menú/user.php" style="
              background: var(--bs-success);
              font-weight: bold;
              margin-top: 10px;">Cancelar</a>
              </div>
            </form>
          </div>
        </div>
        <script src="..\JS\validar_user.js" defer></script>
      </div>
      <footer class="bg-white sticky-footer">
        <div class="container my-auto">
          <div class="text-center my-auto copyright">
            <span><br />TECNM Campus Coalcomán Ingeniería en Sistemas
              Computacionales 6°Semestre -2025<br /><br /></span>
          </div>
        </div>
      </footer>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
  </div>

  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="../assets/js/TableZoomSorter.js"></script>
  <script src="../assets/js/Tema_Admin.js"></script>
  <script src="../assets/js/WaveClickFX.js"></script>


</body>

</html>