<!DOCTYPE html>
<?php



session_start();

if (!isset($_SESSION['user'])) {
  header("Location:login.php");
  die();
}



//conexcion a la base de datos
include '..\..\config\database.php';
// realizamos la sentecia sql
$sql = "SELECT * FROM productos";
//ejecutamos la sentecia y la gardamos en una varible
$result = $conn->query($sql);

?>
<html data-bs-theme="light" lang="en">

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
  <link rel="stylesheet" href="../assets/fonts/typicons.min.css" />
  <link rel="stylesheet" href="../assets/css/bs-theme-overrides.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
</head>

<body id="page-top">

  <div id="wrapper">
    <?php
    include '..\..\Admin\Menú\menu.php';
    ?>
    <!-- Barra lateral de navegación -->

    <div class="d-grid float-end" style="margin-right: 50px">
      <form class="d-none d-sm-inline-block ms-md-3 my-2 my-md-0 mw-100 navbar-search"
        style="background: var(--bs-white); color: rgb(255, 255, 255); margin-right: 20px;">
        <div class="input-group" style="background: var(--bs-light)">
          <input class="bg-light form-control border-0 small" type="text" placeholder="Buscar por nombre o categoría"
            style="background: var(--bs-light); color: rgb(0, 0, 0)" id="searchInput" onkeyup="searchProducts()" />
        </div>
      </form>
    </div>
    <!-- Contenido principal -->
    <div class="col search-table-col" style="margin-top: 50px;">
      <h1 style="color: rgb(0, 0, 0); font-family: Alef, sans-serif; margin-left: 15px;">Productos</h1>

      <?php
      include '..\..\config\database.php';

      // Consulta para obtener los productos con su categoría y descripción
      $sqlProductos = "SELECT p.id, p.nombre, p.precio, c.nombre AS categoria, p.descripcion, 
                        GROUP_CONCAT(i.ruta_imagen SEPARATOR ',') AS rutas_imagen
                 FROM productos p
                 LEFT JOIN categorias c ON p.id_categoria = c.id
                 LEFT JOIN imagenes_producto i ON p.id = i.id_producto
                 GROUP BY p.id";

      $resultProductos = $conn->query($sqlProductos);
      ?>
      <div class="table-responsive" style="margin: 0 50px 40px;">
        <table class="table table-hover text-center">
          <thead style="background: var(--bs-light); color: rgb(0, 0, 0)">
            <tr>
              <th width="16.6%">Nombre</th>
              <th width="16.6%">Precio</th>
              <th width="16.6%">Categoría</th>
              <th width="16.6%">Descripción</th>
              <th width="16.6%">Imagen</th>
              <th width="16.6%">Acciones</th> <!-- Nueva columna para las acciones -->
            </tr>
          </thead>
          <tbody>
            <?php if ($resultProductos->num_rows > 0): ?>
              <?php while ($producto = $resultProductos->fetch_assoc()): ?>
                <tr>
                  <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                  <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                  <td><?php echo htmlspecialchars($producto['categoria']); ?></td>
                  <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                  <td>
                    <?php
                    // Comprobamos si la clave 'rutas_imagen' está definida y tiene imágenes
                    if (isset($producto['rutas_imagen']) && !empty($producto['rutas_imagen'])) {
                      // Si hay imágenes, las separamos en un array
                      $rutasImagen = explode(',', $producto['rutas_imagen']);
                      // Usamos la primera imagen como la principal
                      $imagenPath = "../" . htmlspecialchars($rutasImagen[0]);
                    } else {
                      // Si no hay imágenes, usamos una imagen predeterminada
                      $imagenPath = "../assets/img/productos/default.jpg";
                    }
                    ?>
                    <img src="<?php echo $imagenPath; ?>" alt="Imagen del producto"
                      style="width: 60px; height: 60px; object-fit: cover;"
                      onerror="this.onerror=null; this.src='../assets/img/productos/default.jpg';">
                  </td>
                  <td style="text-align: center">
                    <!-- Botón de editar producto -->
                    <a class="btn btn-primary" role="button" style="background: var(--bs-warning); margin-right: 5px"
                      href="../Edición%20de%20Productos/modify_product.php?producto=<?php echo urlencode($producto['id']); ?>">
                      <i class="fa fa-edit" style="color: var(--bs-black)"></i>
                    </a>

                    <!-- Formulario para eliminar producto -->
                    <form method="POST" action="../Edición%20de%20Productos/delete_products.php" style="display:inline;">
                      <input type="hidden" name="producto" value="<?php echo htmlspecialchars($producto['id']); ?>">
                      <button class="btn btn-primary" type="submit" style="background: var(--bs-form-invalid-color)">
                        <i class="icon ion-android-delete" style="color: var(--bs-light)"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" style="text-align: center;">No hay productos registrados.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>




      <?php $conn->close(); ?>

      <div class="d-grid float-end">
        <a class="btn btn-primary" role="button"
          style="background: var(--bs-info); font-weight: bold; margin-right: 50px;"
          href="../Edición%20de%20Productos/add_product.php">
          Agregar un Nuevo Producto
        </a>
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
  </tr>
  </div>
  </div>

  <!-- Scripts -->
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <!-- buscar productos -->
  <script>
    function searchProducts() {
      // Obtener el valor del input de búsqueda
      let input = document.getElementById('searchInput');
      let filter = input.value.toUpperCase();

      // Obtener la tabla y las filas
      let table = document.querySelector('.table');
      let rows = table.getElementsByTagName('tr');

      // Recorrer todas las filas de la tabla (excepto el encabezado)
      for (let i = 1; i < rows.length; i++) {
        let row = rows[i];
        let name = row.cells[0].textContent.toUpperCase(); // Columna de nombre
        let category = row.cells[2].textContent.toUpperCase(); // Columna de categoría

        // Mostrar u ocultar la fila según coincida con el filtro
        if (name.includes(filter) || category.includes(filter)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      }
    }
  </script>

</body>

</html>
</td>