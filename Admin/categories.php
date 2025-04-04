<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<!-- Incluir conexion PHP -->

<?php
include("../config/database.php");




session_start();



$_SESSION['user'] = "Luna";

if (!isset($_SESSION['user'])) {
  header("Location../Admin/Menú/login.html");
  die();
}



?>

<!-- Fin de la conexión -->

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>Administrador</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=ADLaM+Display&amp;display=swap" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Alef&amp;display=swap" />
  <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css" />
  <link rel="stylesheet" href="assets/fonts/typicons.min.css" />
  <link rel="stylesheet" href="assets/css/bs-theme-overrides.css" />
  <link rel="stylesheet" href="assets/css/Checkbox-Input.css" />
  <link rel="stylesheet" href="assets/css/Features-Cards-icons.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
  <link
    rel="stylesheet"
    href="assets/css/Table-with-Search--Sort-Filters-v20.css" />
  <link rel="stylesheet" href="assets/css/untitled.css" />
</head>

<body>
  <div class="modal fade" role="dialog" tabindex="-1" id="deleteModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="color: rgb(0, 0, 0)">
            ModificadoCorrectamente
          </h4>
          <button
            class="btn-close"
            type="button"
            aria-label="Close"
            data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button
            class="btn btn-light"
            type="button"
            data-bs-dismiss="modal"
            style="
                background: var(--bs-form-valid-border-color);
                color: rgb(255, 255, 255);
              ">
            Ok
          </button>
        </div>
      </div>
    </div>
  </div>
  <div id="wrapper">
    <nav
      class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark"
      style="background: var(--bs-primary)">
      <div class="container-fluid d-flex flex-column p-0">
        <a
          class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
          href="#"><img
            src="assets/img/Logo%20Yesid.svg"
            style="width: 50px; height: 50px; margin-right: -11px" />
          <div class="sidebar-brand-icon rotate-n-15"></div>
          <div class="sidebar-brand-text mx-3">
            <span style="color: var(--bs-black)">Administrador</span>
          </div>
        </a>
        <hr class="sidebar-divider my-0" />
        <ul class="navbar-nav text-light" id="accordionSidebar">
          <li class="nav-item">
            <a class="nav-link" href="../Admin/Menú/index.html"><svg
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
                style="color: rgb(0, 0, 0); font-size: 22.6px">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M13.45 11.55l2.05 -2.05"></path>
                <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path>
              </svg><span style="color: var(--bs-black)">Principal</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Admin/Menú/products.html"><i
                class="typcn typcn-shopping-cart"
                style="color: rgb(0, 0, 0); font-size: 22.6px"></i><span style="color: var(--bs-black)">Productos</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Admin/categories.html"><svg
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
                style="color: rgb(0, 0, 0); font-size: 22.6px">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 4h6v6h-6z"></path>
                <path d="M14 4h6v6h-6z"></path>
                <path d="M4 14h6v6h-6z"></path>
                <path
                  d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
              </svg><span style="color: var(--bs-black); font-weight: bold">Categorías</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Admin/Ofertas/view_produc.html"><svg
                xmlns="http://www.w3.org/2000/svg"
                width="1em"
                height="1em"
                fill="currentColor"
                viewBox="0 0 16 16"
                class="bi bi-currency-dollar"
                style="color: rgb(0, 0, 0); font-size: 22.6px">
                <path
                  d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"></path>
              </svg><span style="color: var(--bs-black)">Ofertas</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Admin/Menú/user.html"><svg
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
          <button
            class="btn rounded-circle border-0"
            id="sidebarToggle"
            type="button"
            style="background: var(--bs-info); color: var(--bs-light)"></button>
        </div>
      </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
      <?php include '../Admin/Menú/menú.php';
      ?>
      <h1 style="color: rgb(0, 0, 0); margin-left: 10px">Categorías</h1>
      <div id="content">
        <div class="d-flex justify-content-end">
          <form
            action="/Admin/JS/search_input.js"
            method="GET"
            class="input-group"
            id="buscador"
            style="background: var(--bs-light)">
            <input
              name="query"
              class="bg-light form-control border-0 small"
              type="text"
              placeholder="Buscar categoría..."
              style="background: var(--bs-light); color: rgb(0, 0, 0)" />
            <button
              class="btn btn-primary py-0"
              type="submit"
              style="color: var(--bs-light); background: var(--bs-info)">
              <i class="fas fa-search"></i>
            </button>
            </form>

        </div>
        <div>
          <div
            class="d-flex justify-content-center align-items-center align-content-center mb-3">
            <div class="table-responsive d-flex justify-content-center">
              <table
                class="table table-striped table tablesorter"
                id="ipi-table">
                <thead class="thead-dark">
                  <tr>
                    <th
                      class="text-center"
                      style="background: var(--bs-info)">
                      Nombre de la categoría
                    </th>
                    <th
                      class="text-center filter-false sorter-false"
                      style="background: var(--bs-info); width: 150px">
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody class="text-center" id="table_cat">

                  .
                  <!-- Verificar si hay registros -->
                  <?php
                  $sql = "SELECT * FROM categorias";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>
            <td style='padding: 10px; border: 1px solid #ddd;'>" . htmlspecialchars($row['nombre']) . "</td>
            <td style='padding: 10px; border: 1px solid #ddd; text-align: center;'>
                <a class='btn btn-success' role='button' 
                   style='margin-left: 5px; background: var(--bs-warning); color: var(--bs-yellow);'
                   href='\Admin\Edición de Productos\modify_cat.php?id=" . $row['id'] . "'>
                    <i class='far fa-edit' style='font-size: 15px; color: rgb(7, 7, 7)'></i>
                </a>
                <button class='btn btn-danger' style='margin-left: 5px' type='button' data-bs-toggle='modal' data-bs-target='#deleteModal" . $row['id'] . "'>
                  <i class='fa fa-trash' style='font-size: 15px'></i>
                </button>

                <!-- Modal -->
                <div class='modal fade' id='deleteModal" . $row['id'] . "' tabindex='-1' aria-labelledby='deleteModalLabel" . $row['id'] . "' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='deleteModalLabel" . $row['id'] . "'>Confirmar Eliminación</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>
                        ¿Estás seguro de que deseas eliminar esta categoría?
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                        <form action='./Edición de Productos/php/eliminar_cat.php' method='post' style='display:inline;'>
                          <input type='hidden' name='id' value='" . $row['id'] . "'>
                          <button class='btn btn-danger' type='submit'>Eliminar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </td>
          </tr>";
                    }
                  } else {
                    echo "<tr><td colspan='2' style='padding: 10px; border: 1px solid #ddd; text-align: center;'>No se encontraron categorías</td></tr>";
                  }
                  ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center align-items-end">
          <a
            class="btn btn-primary btn-icon-split"
            role="button"
            style="background: var(--bs-info); margin-left: 10px"
            href="../Admin/Edición de Productos/add_cat.php"><span class="text-white text">Agregar Nueva Categoría</span></a>
        </div>
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
  <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="color: rgb(0, 0, 0)">
            Estás Seguro de Continuar?
          </h4>
          <button
            class="btn-close"
            type="button"
            aria-label="Close"
            data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p style="color: rgb(0, 0, 0)">Operacion X</p>
        </div>
        <div class="modal-footer">
          <button
            class="btn btn-light"
            type="button"
            data-bs-dismiss="modal"
            style="background: var(--bs-danger)">
            Cancelar</button><button
            class="btn btn-primary"
            type="button"
            style="background: var(--bs-dark)">
            Confirmar
          </button>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="assets/js/TableZoomSorter.js"></script>
  <script src="assets/js/Tema_Admin.js"></script>
  <script src="assets/js/WaveClickFX.js"></script>
  <script src="/Admin/JS/search_input.js"></script>
</body>

</html>