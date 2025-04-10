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
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>Dashboard - Brand</title>
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ADLaM+Display&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alef&amp;display=swap" />
  <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css" />
  <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css" />
  <link rel="stylesheet" href="../assets/fonts/ionicons.min.css" />
  <link rel="stylesheet" href="../assets/fonts/typicons.min.css" />
  <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css" />
  <link rel="stylesheet" href="../assets/css/bs-theme-overrides.css" />
  <link rel="stylesheet" href="../assets/css/Checkbox-Input.css" />
  <link rel="stylesheet" href="../assets/css/Features-Cards-icons.css" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
  <link rel="stylesheet" href="../assets/css/Table-with-Search--Sort-Filters-v20.css" />
  <link rel="stylesheet" href="../assets/css/untitled.css" />
</head>

<body id="page-top">
  <div id="wrapper">

    <!-- incluir menu -->
    <?php include '..\..\Admin\Menú\menu.php'; ?>
    <!-- incluir menu -->

    <div class="d-grid float-end" style="margin-right: 50px">
      <form class="d-none d-sm-inline-block ms-md-3 my-2 my-md-0 mw-100 navbar-search" style="
                background: var(--bs-white);
                color: rgb(255, 255, 255);
                margin-right: 20px;
              ">
        <div class="input-group" style="background: var(--bs-light)">
          <input id="searchInput" class="bg-light form-control border-0 small" type="text"
            placeholder="Buscar usuario o nombre..." style="background: var(--bs-light); color: rgb(0, 0, 0)"
            onkeyup="searchUsers()" id="searchInput" />
        </div>
      </form>
    </div>
    <div>
      <h1 style="
                padding-bottom: 15px;
                color: rgb(0, 0, 0);
                font-family: Alef, sans-serif;
                margin-left: 15px;
              ">
        Usuarios
      </h1>
      <div class="table-responsive text-center d-flex" style="
                margin-left: 50px;
                margin-right: 50px;
                border-top-left-radius: 2px;
                border-top-right-radius: 2px;
                border-bottom-right-radius: 2px;
                border-bottom-left-radius: 2px;
              ">

        <!-- Tabla completa de usuarios -->
        <table class="table table-hover">
          <thead>
            <tr style="background: var(--bs-info)" width="100%">
              <th style="background: var(--bs-table-accent-bg)" width="30%">
                Usuario
              </th>
              <th style="background: var(--bs-table-accent-bg)" width="30%">
                Nombre
              </th>
              <th style="background: var(--bs-table-accent-bg)" width="30%">
                Imagen
              </th>
              <th style="background: var(--bs-table-accent-bg)" width="10%">
                Acción
              </th>
            </tr>
          </thead>

          <!-- Se conecta a la base de datos y se obtienen los datos de la tabla Usuarios -->
          <?php
          include '..\..\config\database.php';

          // Opción 1: Usando $conn directamente
          $resultado = $conn->query("SELECT * FROM Usuarios");

          ?>
          <tbody id="userTable">

            <!-- Inicia datos ingresados a la tabla de usuarios -->
            <?php if ($resultado->num_rows > 0): ?>
              <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                  <td><?php echo htmlspecialchars($fila['usuario']); ?></td>
                  <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                  <td style="text-align: center">
                    <?php
                    $imagenArchivo = !empty($fila['imagen']) ? $fila['imagen'] : 'default.jpg';
                    $imagenPath = "/Admin/assets/img/avatars/" . htmlspecialchars($imagenArchivo);
                    ?>
                    <img src="<?php echo $imagenPath; ?>" alt="Imagen de <?php echo htmlspecialchars($fila['usuario']); ?>"
                      style="width: 50px; height: 50px;"
                      onerror="this.onerror=null; this.src='/Admin/assets/img/avatars/default.jpg';">
                  </td>
                  <td style="text-align: center">
                    <a class="btn btn-primary" role="button" style="background: var(--bs-warning); margin-right: 5px"
                      href="../Edición%20de%20Usuarios/modify_user.php?usuario=<?php echo urlencode($fila['usuario']); ?>">
                      <i class="fa fa-edit" style="color: var(--bs-black)"></i>
                    </a>
                    <form method="POST" action="../Edición%20de%20Usuarios/delete_user.php" style="display:inline;">
                      <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($fila['usuario']); ?>">
                      <button class="btn btn-primary" type="submit" style="background: var(--bs-form-invalid-color)">
                        <i class="icon ion-android-delete" style="color: var(--bs-light)"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" style="text-align: center; font-weight: bold;">
                  <p>No hay usuarios registrados actualmente</p>

                </td>
              </tr>
            <?php endif; ?>



            <!-- Termina los datos ingresados a la tabla de usuarios -->

          </tbody>

          <?php $conn->close(); ?>

        </table>
        <!-- Termina la tabla de usuarios -->
      </div>
      <div class="d-grid float-end">
        <a class="btn btn-primary" role="button" style="
                  background: var(--bs-info);
                  font-weight: bold;
                  margin-right: 50px;
                " href="../Edición%20de%20Usuarios/add_user.php">Agregar un Nuevo Usuario</a>
      </div>
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
  <div class="modal" role="dialog" tabindex="-1" id="miModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="color: rgb(0, 0, 0)">
            Esta seguro de continuar con la operación?
          </h4>
          <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Operación X</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-light" type="button" data-bs-dismiss="modal">
            Cancelar</button><button class="btn btn-primary" type="button" style="background: var(--bs-danger)">
            Confirmar
          </button>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script>
    function cargarDatosModificacion(id, nombre, contraseña) {
      localStorage.setItem('usuarioEditar', JSON.stringify({
        id: id,
        nombre: nombre,
        contraseña: contraseña,
      }));
    }
  </script>


  <script>

    //Este script es para buscar los usuarios o nombres en la tabla de usuarios principal
    //Inicia la función de búsqueda de usuarios
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