<!DOCTYPE html>
<html data-bs-theme="light" lang="es" style="background: #abba87">

<body style="background: #abba87">

  <?php
  // Incluir el menú principal después de abrir el body
  include '../../Views/Paginas Principales/menu_principal.php';
  include '../../config/database.php';

  // Configuración de rutas - MODIFICADO para apuntar a Admin
  define('IMG_BASE_URL', '../../Admin/assets/img/productos/');
  define('IMG_DEFAULT', '../../Admin/assets/img/productos/default.jpg');

  $nombre_categoria = isset($_GET['categoria']) ? htmlspecialchars($_GET['categoria']) : 'Todos los productos';

  // CONSULTA OPTIMIZADA
  if (isset($_GET['categoria'])) {
    $stmt = $conn->prepare("SELECT p.*, 
                          (SELECT ip.ruta_imagen FROM imagenes_producto ip 
                           WHERE ip.id_producto = p.id 
                           ORDER BY ip.id LIMIT 1) as imagen_principal
                          FROM productos p
                          JOIN categorias c ON p.id_categoria = c.id
                          WHERE c.nombre = ?");
    $stmt->bind_param("s", $nombre_categoria);
  } else {
    $stmt = $conn->prepare("SELECT p.*, 
                          (SELECT ip.ruta_imagen FROM imagenes_producto ip 
                           WHERE ip.id_producto = p.id 
                           ORDER BY ip.id LIMIT 1) as imagen_principal
                          FROM productos p");
  }

  $stmt->execute();
  $resultProductos = $stmt->get_result();
  ?>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Catálogo de Productos</title>
    <meta name="description" content="Catálogo de productos por categoría" />

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ADLaM+Display&amp;display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=AR+One+Sans&amp;display=swap" />
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/fonts/simple-line-icons.min.css" />
    <link rel="stylesheet" href="../assets/css/bs-theme-overrides.css" />
    <link rel="stylesheet" href="../assets/css/Animated-Pretty-Product-List-v12-Animated-Pretty-Product-List.css" />
    <link rel="stylesheet" href="../assets/css/baguetteBox.min.css" />
    <link rel="stylesheet" href="../assets/css/Banner-Heading-Image-images.css" />
    <link rel="stylesheet" href="../assets/css/dark_navbar.css" />
    <link rel="stylesheet" href="../assets/css/Dark-NavBar-Navigation-with-Button.css" />
    <link rel="stylesheet" href="../assets/css/Dark-NavBar-Navigation-with-Search.css" />
    <link rel="stylesheet" href="../assets/css/Footer---4-Columns---No-Social-Networks.css" />
    <link rel="stylesheet" href="../assets/css/Footer-Clean-icons.css" />
    <link rel="stylesheet" href="../assets/css/multiple-item-carousel-slider.css" />
    <link rel="stylesheet" href="../assets/css/vanilla-zoom.min.css" />
  </head>

  <main class="page">
    <section class="clean-block" style="background: #d9dcbd; height: 181.15px">
      <div class="container">
        <div class="block-heading">
          <h2 style="
                border-color: #587a2e;
                border-top-color: rgb(59, 153, 224);
                border-right-color: rgb(59, 153, 224);
                border-bottom-color: rgb(59, 153, 224);
                border-left-color: rgb(59, 153, 224);
                color: #587a2e;
                font-family: 'ADLaM Display', serif;
              ">
            <?php echo $nombre_categoria; ?>
          </h2>
        </div>
      </div>
    </section>
  </main>

  <div class="container" style="background: #abba87; margin-top: 38px; padding-bottom: 30px;">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
      <?php if ($resultProductos->num_rows > 0): ?>
        <?php while ($producto = $resultProductos->fetch_assoc()): ?>
          <?php
          // Construir la ruta de la imagen correctamente
          if (isset($producto['imagen_principal']) && !empty($producto['imagen_principal'])) {
            // Extraer solo el nombre del archivo de la ruta almacenada
            $nombre_archivo = basename($producto['imagen_principal']);
            // Construir la nueva ruta usando la ubicación en Admin
            $imagenPath = IMG_BASE_URL . $nombre_archivo;
          } else {
            $imagenPath = IMG_DEFAULT;
          }
          ?>

          <div class="col">
            <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px;">
              <a class="text-decoration-none" href="producto_detalle.php?id=<?= $producto['id'] ?>">
                <div class="p-3 h-100 d-flex flex-column">
                  <div class="bg-light d-flex justify-content-center align-items-center"
                    style="height: 200px; overflow: hidden; border-radius: 15px;">
                    <img class="img-fluid mh-100" src="<?= $imagenPath ?>" style="object-fit: contain; max-width: 100%;"
                      alt="<?= htmlspecialchars($producto['nombre']) ?>"
                      onerror="this.onerror=null; this.src='<?= IMG_DEFAULT ?>';">
                  </div>
                  <div class="mt-3 flex-grow-1 d-flex flex-column">
                    <h3 class="h5 mb-2 text-dark"><?= htmlspecialchars($producto['nombre']) ?></h3>
                    <p class="small text-muted mb-3 flex-grow-1">
                      <?= mb_substr(htmlspecialchars($producto['descripcion']), 0, 100) ?>
                      <?= (mb_strlen($producto['descripcion']) > 100) ? '...' : '' ?>
                    </p>
                    <div class="mt-auto text-center">
                      <span class="fw-bold text-success">$<?= number_format($producto['precio'], 2) ?></span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="alert alert-info text-center py-4">
            <i class="fas fa-info-circle me-2"></i> No se encontraron productos en esta categoría.
            <a href="/Views/Paginas%20Principales/index_prin.php" class="btn btn-sm btn-outline-success ms-3">
              Ver pagina principal
            </a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- inicia footer -->
  <?php include '../../Views/Paginas Principales/footer_principal.php'; ?>
  <!-- termina footer -->

  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/baguetteBox.min.js"></script>
  <script>
    // Depuración de imágenes
    document.addEventListener('DOMContentLoaded', function () {
      console.log("=== DEPURACIÓN DE IMÁGENES ===");

      document.querySelectorAll('img').forEach(img => {
        console.group("Imagen: " + img.alt);
        console.log("Ruta de la imagen:", img.src);
        console.log("¿Se cargó correctamente?", img.complete && img.naturalHeight !== 0 ? "Sí" : "No");
        console.groupEnd();
      });
    });
  </script>
</body>
</html>