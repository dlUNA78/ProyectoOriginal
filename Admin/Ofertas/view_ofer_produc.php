<!DOCTYPE html>

<?php

include '..\..\config\database.php';
//eliminar ofertas caducadas
// Eliminar ofertas cuya fecha de salida es menor que hoy
$hoy = date("Y-m-d");
$sql = "DELETE FROM ofertas WHERE Fecha_expirada < '$hoy'";

if ($conn->query($sql) === TRUE) { 
   // echo "Ofertas vencidas eliminadas correctamente.";
} else {
    echo "Error eliminando ofertas: " . $conn->error;
}

//$conn->close(); 
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
              <a class="nav-link" href="view_produc.php"
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
                ><span style="color: var(--bs-black); font-weight: bold"
                  >Ofertas</span
                ></a
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
        <div id="content">
          <div class="d-grid float-end" id="form" style="margin-right: 50px">
            <form
              class="d-none d-sm-inline-block ms-md-3 my-2 my-md-0 mw-100 navbar-search"
              style="
                background: var(--bs-white);
                color: rgb(255, 255, 255);
                margin-right: 0px;
              "
            >
              <div class="input-group" style="background: var(--bs-light)">
                <input
                  class="bg-light form-control border-0 small"
                  type="text"
                  placeholder="Buscar...Producto..."
                  style="background: var(--bs-light); color: rgb(0, 0, 0)"
                /><button
                  class="btn btn-primary py-0"
                  type="button"
                  style="color: var(--bs-light); background: var(--bs-info)"
                >
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </form>
          </div>
          <div
            class="col search-table-col"
            style="
              margin: 9px 0px 0px;
              margin-top: 50px;
              margin-left: 50px;
              margin-right: 50px;
              margin-bottom: 50px;
            "
          >
            <h1
              style="
                color: rgb(0, 0, 0);
                font-family: Nunito, sans-serif;
                margin-left: 15px;
              "
            >
            <div style="margin: 10px 15px;">
  <input
    type="text"
    id="searchInput"
    onkeyup="searchOfertas()"
    placeholder="Buscar producto por nombre..."
    class="form-control"
    style="max-width: 300px;"
    
  />
</div>
              Productos en Oferta
            </h1>
            
            
<!-- no borara por que se me descuadra -->
            <div class="d-grid float-end" style="margin-right: 50px"> 
  
</div>

<div>
  
  <div class="table-responsive text-center d-flex" style="margin-left: 50px; margin-right: 50px; border-top-left-radius: 2px; border-top-right-radius: 2px; border-bottom-right-radius: 2px; border-bottom-left-radius: 2px;">
  
    <!-- Tabla de Ofertas -->
    <table class="table table-hover">
      <thead>
        <tr style="background: var(--bs-info)" width="100%">
          <th style="background: var(--bs-table-accent-bg)" width="10%">Imagen</th>
          <th style="background: var(--bs-table-accent-bg)" width="20%">Nombre de la Oferta</th>
          <th style="background: var(--bs-table-accent-bg)" width="10%">Precio</th>
          <th style="background: var(--bs-table-accent-bg)" width="10%">Precio de Oferta</th>
          <th style="background: var(--bs-table-accent-bg)" width="10%">Fecha de inicio</th>
          <th style="background: var(--bs-table-accent-bg)" width="10%">Fecha de expiracion</th>
          <th style="background: var(--bs-table-accent-bg)" width="10%">Acción</th>
        </tr>
      </thead>

      <?php
      include '..\..\config\database.php';
      $resultado = $conn->query("SELECT * FROM ofertas");
      ?>

      <tbody id="offerTable">

        <!-- Datos de la tabla -->
        <?php if ($resultado->num_rows > 0): ?>
          <?php while ($fila = $resultado->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($fila['imagen']); ?></td>
              <td><?php echo htmlspecialchars($fila['Nombre_oferta']); ?></td>
              <td>$<?php echo number_format($fila['precio'], 2); ?></td>
              <td>$<?php echo number_format($fila['precio_oferta'], 2); ?></td>
              <td><?php echo $fila['Fecha_inicio'] !== null ? htmlspecialchars($fila['Fecha_inicio']) : 'N/A'; ?></td>
              <td><?php echo $fila['Fecha_expirada'] !== null ? htmlspecialchars($fila['Fecha_expirada']) : 'N/A'; ?></td>

              
              <!-- Columna de Imagen -->
              
             
              <!-- Acciones -->
              <td style="text-align: center">
                <a class="btn btn-primary" role="button" style="background: var(--bs-warning); margin-right: 5px"
                  href="..\Edición de Productos\modify_offer.php?id=<?php echo urlencode($fila['id_oferta']); ?>">
                  <i class="fa fa-edit" style="color: var(--bs-black)"></i>
                </a>
                <form method="POST" action="../Edición%20de%20Ofertas/delete_offer.php" style="display:inline;">
                  <input type="hidden" name="id_oferta" value="<?php echo htmlspecialchars($fila['id_oferta']); ?>">
                  <button class="btn btn-primary" type="submit" style="background: var(--bs-form-invalid-color)">
                    <i class="icon ion-android-delete" style="color: var(--bs-light)"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" style="text-align: center; font-weight: bold;">
              <p>No hay ofertas disponibles actualmente</p>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>

      <?php $conn->close(); ?>

    </table>
    <!-- Fin de la tabla de ofertas -->
  </div>
          <div class="d-grid float-end">
            <a class="btn btn-primary" role="button" style="
                  background: var(--bs-info);
                  font-weight: bold;
                  margin-right: 50px;
                " href="../Ofertas/add_offer.php">Agregar nueva oferta</a>
          </div>

            </div>
          </div>
        </div>
        <footer class="bg-white sticky-footer">
          <div class="container my-auto">
            <div class="text-center my-auto copyright">
              <span>TECNM Campus Coalcomán Ingeniería en Sistemas Computacionales 6°Semestre -2025</span>
            </div>
          </div>
        </footer>
      </div>
      <a class="border rounded d-inline scroll-to-top" href="#page-top"
        ><i class="fas fa-angle-up"></i
      ></a>
    </div>
    <div class="modal" role="dialog" tabindex="-1" id="miModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="color: rgb(0, 0, 0)">
              Esta seguro de continuar con la operación?
            </h4>
            <button
              class="btn-close"
              type="button"
              aria-label="Close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body">
            <p>Operación X</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-light" type="button" data-bs-dismiss="modal">
              Cancelar</button
            ><button
              class="btn btn-primary"
              type="button"
              style="background: var(--bs-danger)"
            >
              Confirmar
            </button>
          </div>
        </div>
      </div>
      
    </div>
    <script>
    function cargarDatosModificacion(id, nombre, precio) {
      localStorage.setItem('usuarioEditar', JSON.stringify({
        id: id,
        nombre: nombre,
        contraseña: precio,
      }));
    }
  </script>


    <script>

  
    //Inicia la función de búsqueda de nombres
    function searchUsers() {
      const input = document.getElementById('searchInput');
      const filter = input.value.toUpperCase();
      const table = document.querySelector('table'); // Asegúrate de que selecciona la tabla correcta
      const tr = table.getElementsByTagName('tr');

      // Convertimos las filas a un array para poder ordenarlas
      const rowsArray = Array.from(tr).slice(1); // Excluimos el encabezado

      // Ordenamos las filas según la coincidencia
      rowsArray.sort((a, b) => {
        const aUser = a.getElementsByTagName('td')[0].textContent.toUpperCase();
        const aName = a.getElementsByTagName('td')[1].textContent.toUpperCase();
        const bUser = b.getElementsByTagName('td')[0].textContent.toUpperCase();
        const bName = b.getElementsByTagName('td')[1].textContent.toUpperCase();
        

        // Calculamos puntajes de coincidencia
        const aUserScore = calculateMatchScore(aUser, filter);
        const aNameScore = calculateMatchScore(aName, filter);
        const bUserScore = calculateMatchScore(bUser, filter);
        const bNameScore = calculateMatchScore(bName, filter);

        // Tomamos el mejor puntaje para cada fila
        const aMaxScore = Math.max(aUserScore, aNameScore);
        const bMaxScore = Math.max(bUserScore, bNameScore);

        // Ordenamos de mayor a menor puntaje
        return bMaxScore - aMaxScore;
      });

      // Mostramos/ocultamos filas según si coinciden
      rowsArray.forEach(row => {
        const user = row.getElementsByTagName('td')[0].textContent.toUpperCase();
        const name = row.getElementsByTagName('td')[1].textContent.toUpperCase();

        if (user.includes(filter) || name.includes(filter) || filter === '') {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });

      // Reinsertamos las filas ordenadas
      const tbody = table.querySelector('tbody');
      rowsArray.forEach(row => tbody.appendChild(row));
    }

    function calculateMatchScore(text, filter) {
      if (filter === '') return 0;

      // Puntaje más alto si coincide desde el inicio
      if (text.startsWith(filter)) return 3;

      // Puntaje medio si contiene el filtro
      if (text.includes(filter)) return 2;

      // Puntaje bajo si coincide parcialmente (solo algunas letras)
      const filterLetters = filter.split('');
      const matches = filterLetters.filter(letter => text.includes(letter)).length;
      return matches / filterLetters.length;
    }
  </script>
  <!-- Termina la función de búsqueda por usuarios o nombres en la tabla de usuarios principal -->

    







    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="../assets/js/TableZoomSorter.js"></script>
    <script src="../assets/js/Tema_Admin.js"></script>
    <script src="../assets/js/WaveClickFX.js"></script>
    <script src="../JS/ofertas/get_values_table_offer.js"></script>
    <script>
      function editButtonClick(button) {
        getTableValues(button);
      }
    </script>
  </body>
</html>
