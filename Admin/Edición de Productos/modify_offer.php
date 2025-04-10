<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<?php
session_start();

if (!isset($_SESSION['user'])) {
  header("Location:login.php");
  die();
}


?>
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
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css" />
    <link rel="stylesheet" href="../assets/fonts/typicons.min.css" />
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



<?php
// Configuración de la conexión PDO
include '..\..\config\database.php';


if (isset($_GET['id'])) {
    $id_oferta = $_GET['id'];
    
    $stmt = $conn->prepare("SELECT * FROM ofertas WHERE id = ?");
    $stmt->bind_param("i", $id_oferta);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $oferta = $resultado->fetch_assoc();
    } else {
        echo "No se encontró la oferta";
        exit;
    }
} else {
    echo "ID de oferta no proporcionado";
    exit;
}
?>



<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['Nombre_oferta'];
    $precio = $_POST['precio'];
    $precio_oferta = $_POST['precio_oferta'];
    $fecha_inicio = $_POST['Fecha_inicio'];
    $fecha_expirada = $_POST['Fecha_expirada'];

    // Si subió una nueva imagen
    //if (!empty($_FILES['imagen']['name'])) {
    //    $nombre_imagen = $_FILES['imagen']['name'];
    //    $ruta_imagen = '../../ruta/imagenes/' . $nombre_imagen; // Ajusta la ruta según tu estructura
    //    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);
    //} else {
        // Mantener la imagen anterior
    //    $query = $conn->prepare("SELECT imagen FROM ofertas WHERE id_oferta = ?");
    //    $query->bind_param("i", $id);
    //    $query->execute();
    //    $resultado = $query->get_result()->fetch_assoc();
    //    $nombre_imagen = $resultado['imagen'];
    //}

    $stmt = $conn->prepare("UPDATE ofertas SET Nombre_oferta=?, precio=?, precio_oferta=?, Fecha_inicio=?, Fecha_expirada=? WHERE id=?");
    $stmt->bind_param("sddsssi", $nombre, $precio, $precio_oferta, $fecha_inicio, $fecha_expirada, $nombre_imagen, $id);

    if ($stmt->execute()) {
        header("Location: ../Ofertas/listado_ofertas.php?actualizado=1");
        exit;
    } else {
        echo "Error al actualizar la oferta";
    }
}
?>








    <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="color: rgb(0, 0, 0)">
              Modificado Correctamente
            </h4>
            <button
              class="btn-close"
              type="button"
              aria-label="Close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer">
            <button
              class="btn btn-light"
              type="button"
              data-bs-dismiss="modal"
              style="background: var(--bs-form-valid-border-color)"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <div id="wrapper">
      <nav
        class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark"
        style="background: var(--bs-primary)"
      >
        <div class="container-fluid d-flex flex-column p-0">
          <a
            class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
            href="#"
            ><img
              src="../assets/img/Logo%20Yesid.svg"
              style="width: 50px; height: 50px; margin-right: -11px"
            />
            <div class="sidebar-brand-icon rotate-n-15"></div>
            <div class="sidebar-brand-text mx-3">
              <span style="color: var(--bs-black)">Administrador</span>
            </div>
          </a>
          <hr class="sidebar-divider my-0" />
          <ul class="navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item">
              <a class="nav-link" href="../Menú/index.php"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="icon icon-tabler icon-tabler-dashboard"
                  style="color: rgb(0, 0, 0); font-size: 22.6px"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                  <path d="M13.45 11.55l2.05 -2.05"></path>
                  <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path></svg
                ><span style="color: var(--bs-black)">Principal</span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../Menú/products.php"
                ><i
                  class="typcn typcn-shopping-cart"
                  style="color: rgb(0, 0, 0); font-size: 22.6px"
                ></i
                ><span style="color: var(--bs-black)">Productos</span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../categories.php"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="icon icon-tabler icon-tabler-category"
                  style="color: rgb(0, 0, 0); font-size: 22.6px"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M4 4h6v6h-6z"></path>
                  <path d="M14 4h6v6h-6z"></path>
                  <path d="M4 14h6v6h-6z"></path>
                  <path
                    d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"
                  ></path></svg
                ><span style="color: var(--bs-black)">Categorías</span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../Ofertas/view_produc.php"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  fill="currentColor"
                  viewBox="0 0 16 16"
                  class="bi bi-currency-dollar"
                  style="color: rgb(0, 0, 0); font-size: 22.6px"
                >
                  <path
                    d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"
                  ></path></svg
                ><span style="color: var(--bs-black)">Ofertas</span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../Menú/user.php"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="icon icon-tabler icon-tabler-users"
                  style="font-size: 22.6px; color: rgb(0, 0, 0)"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                  <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg
                ><span style="color: var(--bs-black)">Usuarios</span></a
              >
            </li>
          </ul>
          <div class="text-center d-none d-md-inline">
            <button
              class="btn rounded-circle border-0"
              id="sidebarToggle"
              type="button"
              style="background: var(--bs-info); color: var(--bs-light)"
            ></button>
          </div>
        </div>
      </nav>
      <div class="d-flex flex-column" id="content-wrapper">
        <nav class="navbar navbar-expand bg-white shadow mb-4 topbar">
          <div class="container-fluid">
            <button
              class="btn btn-link d-md-none rounded-circle me-3"
              id="sidebarToggleTop"
              type="button"
            >
              <i class="fas fa-bars"></i>
            </button>
            <ul class="navbar-nav flex-nowrap ms-auto">
              <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow">
                  <a
                    class="dropdown-toggle nav-link"
                    aria-expanded="false"
                    data-bs-toggle="dropdown"
                    href="#"
                    ><span class="d-none d-lg-inline me-2 text-gray-600 small"
                      >Yesid Amalec</span
                    ><img
                      class="border rounded-circle img-profile"
                      src="../assets/img/avatars/avatar1.jpeg"
                  /></a>
                  <div
                    class="dropdown-menu shadow dropdown-menu-end animated--grow-in"
                  >
                    <a class="dropdown-item" href="../Menú/login.php"
                      ><i
                        class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"
                      ></i
                      >&nbsp;Cerrar Sesión</a
                    >
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        <div
          class="d-flex justify-content-center align-items-center"
          id="content"
        >

        
          <div class="card shadow-sm p-4">
            <h2
              class="text-center mb-4"
              style="color: rgb(0, 0, 0); font-weight: bold"
            >
              Modificar Oferta
            </h2>
            <form novalidate>
              <div class="mb-3">
                <label
                  class="form-label"
                  for="nombre"
                  style="color: rgb(0, 0, 0)"
                  >Nombre del Producto:</label
                >
                <input
                  class="form-control form-control"
                  type="text"
                  id="nombre"
                  required=""
                />
              </div>
              <div class="mb-3">
                <label
                  class="form-label"
                  for="codigo-1"
                  style="color: rgb(0, 0, 0)"
                  >Precio:</label
                >
                <input id="precioBe" class="form-control" type="search" />
              </div>
              <div class="mb-3">
                <label
                  class="form-label"
                  for="existencia"
                  style="color: rgb(0, 0, 0)"
                  >Precio con descuento:</label
                >
                <input
                  id="precioNew"
                  class="form-control form-control"
                  type="number"
                  required=""
                />
                <div id="errorPrecioNew" class="text-danger"></div>
              </div>

              <div class="mb-3">
                <label
                required=""
                style="color: rgb(0, 0, 0)"
                >Fecha de inicio:</label>
              <input type="date" name="fecha_salida"><br><br>
              </div>

              <div class="mb-3">
              <label
              style="color: rgb(0, 0, 0)"
              required=""
              >Fecha de expiracion:</label>
              <input type="date" name="fecha_salida"><br>
              </div>
              
              <div class="mb-3"></div>
              <div class="d-flex justify-content-end gap-2">
                <button
                  id="btn_agregar"
                  class="btn btn-primary"
                  type="submit"
                  style="
                    background: var(--bs-info);
                    font-weight: bold;
                    margin-top: 10px;
                  "
                  href="../Ofertas/view_ofer_produc.php"
                  >Agregar</button
                ><a
                  class="btn btn-secondary"
                  role="button"
                  style="
                    background: var(--bs-success);
                    font-weight: bold;
                    margin-top: 10px;
                  "
                  href="../Ofertas/view_ofer_produc.php"
                  >Cancelar</a>
              </div>




              
            </form>
          </div>
        </div>
        <footer class="bg-white sticky-footer">
          <div class="container my-auto">
            <div class="text-center my-auto copyright">
              <span
                ><br />TECNM Campus Coalcomán Ingeniería en Sistemas
                Computacionales 6°Semestre -2025<br /><br
              /></span>
            </div>
          </div>
        </footer>
      </div>
      <a class="border rounded d-inline scroll-to-top" href="#page-top"
        ><i class="fas fa-angle-up"></i
      ></a>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="../assets/js/TableZoomSorter.js"></script>
    <script src="../assets/js/Tema_Admin.js"></script>
    <script src="../assets/js/WaveClickFX.js"></script>
    <script src="../JS/validar_mod_offer.js"></script>
  </body>
</html>

