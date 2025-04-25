<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<?php
include '..\..\config\database.php';
session_start();

if (!isset($_SESSION['user'])) {
  header("Location:login.php");
  die();
}

// Obtener categorías
$sql = "SELECT id, nombre FROM categorias";
$resultado = $conn->query($sql);
$categorias = [];

if ($resultado->num_rows > 0) {
  while ($fila = $resultado->fetch_assoc()) {
    $categorias[] = $fila;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['Descripción'];
  $precio = $_POST['precio'];
  $categoria = $_POST['categoria'];

  // Insertar producto
  $sql = "INSERT INTO productos (nombre, descripcion, precio, id_categoria) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $categoria);
  $stmt->execute();
  $producto_id = $stmt->insert_id;
  $stmt->close();

  // Manejo de imágenes
  $imagenes = $_FILES['imagen'];

  if (!empty($imagenes['name'][0])) {
    // Ruta absoluta del directorio donde guardar las imágenes
    $carpetaDestino = realpath(__DIR__ . '/../../Admin/assets/img/productos') . DIRECTORY_SEPARATOR;

    if (!is_dir($carpetaDestino)) {
      if (!mkdir($carpetaDestino, 0777, true)) {
        die("No se pudo crear la carpeta de destino: $carpetaDestino");
      }
    }

    // Recorremos cada imagen
    for ($i = 0; $i < count($imagenes['name']); $i++) {
      if ($imagenes['error'][$i] === UPLOAD_ERR_OK) {
        $nombreOriginal = basename($imagenes['name'][$i]);
        $nombreFinal = uniqid() . "_" . $nombreOriginal;
        $rutaCompleta = $carpetaDestino . $nombreFinal;
        $rutaEnDB = 'assets/img/productos/' . $nombreFinal;

        if (move_uploaded_file($imagenes['tmp_name'][$i], $rutaCompleta)) {
          // Guardamos la ruta relativa en la base de datos
          $sqlImg = "INSERT INTO imagenes_producto (id_producto, ruta_imagen) VALUES (?, ?)";
          $stmtImg = $conn->prepare($sqlImg);
          $stmtImg->bind_param("is", $producto_id, $rutaEnDB);
          $stmtImg->execute();
          $stmtImg->close();
        } else {
          echo "Error al subir la imagen: " . $nombreOriginal . "<br>";
        }
      } else {
        echo "Error al subir la imagen: " . $imagenes['name'][$i] . " (Código de error: " . $imagenes['error'][$i] . ")<br>";
      }
    }
  } else {
    echo "No se seleccionaron imágenes o hubo un error al intentar cargar las imágenes.";
  }

  header("Location: ../Menú/products.php?status=success");
  exit();
}
?>





<head>
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
  <!-- Modal -->
  <div class="modal fade" role="dialog" tabindex="-1" id="Agregado">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="color: rgb(0, 0, 0)">
            Agregado Correctamente
          </h4>
          <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button class="btn btn-light" type="button" data-bs-dismiss="modal" style="
                background: var(--bs-form-valid-border-color);
                color: rgb(255, 255, 255);
              ">
            Ok
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Terrmina el Modal -->
  <div id="wrapper">
    <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark"
      style="background: var(--bs-primary)">
      <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#"><img
            src="../assets/img/Logo%20Yesid.svg" style="width: 50px; height: 50px; margin-right: -11px" />
          <div class="sidebar-brand-icon rotate-n-15"></div>
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
            <a class="nav-link" href="../Menú/products.html"><i class="typcn typcn-shopping-cart"
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
            <a class="nav-link" href="../Menú/user.php"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round" class="icon icon-tabler icon-tabler-users"
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
                  <a class="dropdown-item" href="../Menú/login.html"><i
                      class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Cerrar Sesión</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <div class="d-flex justify-content-center align-items-center" id="content">
        <div class="container d-flex flex-row justify-content-center" style="
              margin-left: 0px;
              margin-right: 0px;
              height: auto;
              width: 500px;
              margin-top: 0px;
              margin-bottom: 40px;
            ">
          <div class="card shadow-sm p-4">
            <h2 class="text-center mb-4" style="color: rgb(0, 0, 0); font-weight: bold">
              Agregar productos
            </h2>
            <form action="/Admin/Edición de Productos/add_product.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label" for="nombre" style="color: rgb(0, 0, 0)">Nombre del producto:</label>
                <input class="form-control" type="text" id="nombre" name="nombre" required="" />
              </div>
              <div class="mb-3">
                <label class="form-label" for="descripcion" style="color: rgb(0, 0, 0)">Descripción:</label>
                <input class="form-control" type="text" id="name-1" name="Descripción">
              </div>
              <div class="mb-3">
                <label class="form-label" for="precio" style="color: rgb(0, 0, 0)">Precio:</label>
                <input class="form-control" type="text" id="precio" name="precio" required="" />
              </div>
              <div class="mb-3">
                <label class="form-label" for="categoria" style="color: rgb(0, 0, 0)">Categoría:</label>
                <select class="form-select" id="categoria" name="categoria" required="">
                  <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id'] ?>"><?= htmlspecialchars($categoria['nombre']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label" for="imagenes" style="color: rgb(0, 0, 0)">Agregar Imágenes:</label>
                <input class="form-control" type="file" name="imagen[]" multiple>
              </div>
              <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-primary" type="submit" id="btnAgregar"
                  style="background: var(--bs-info);">Agregar</button>
                <a class="btn btn-secondary" href="../Menú/products.php"
                  style="background: var(--bs-success);">Cancelar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <footer class="bg-white sticky-footer">
        <div class="container my-auto">
          <div class="text-center my-auto copyright">
            <span><br />TECNM Campus Coalcomán Ingeniería en Sistemas
              Computacionales 6° Semestre - 2025<br /><br /></span>
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
  <script src="../JS/validar_add_prod.js"></script>
</body>

</html>