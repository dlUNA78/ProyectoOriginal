<!DOCTYPE html>
<html data-bs-theme="light" lang="es" style="background: #abba87">
<?php
include '../../Views/Paginas Principales/menu_principal.php';
include '../../config/database.php';

// Obtener el ID del producto desde la URL
$id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consulta para obtener los detalles del producto
$stmt = $conn->prepare("SELECT p.*, c.nombre as categoria 
                       FROM productos p
                       JOIN categorias c ON p.id_categoria = c.id
                       WHERE p.id = ?");
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$producto = $stmt->get_result()->fetch_assoc();

// Consulta para obtener todas las imágenes del producto
$stmt_img = $conn->prepare("SELECT ruta_imagen FROM imagenes_producto WHERE id_producto = ?");
$stmt_img->bind_param("i", $id_producto);
$stmt_img->execute();
$imagenes = $stmt_img->get_result()->fetch_all(MYSQLI_ASSOC);

// Configuración de rutas MODIFICADA para Admin
define('IMG_BASE_URL', '../../Admin/assets/img/productos/');
define('IMG_DEFAULT', '../../Admin/assets/img/productos/default.jpg');
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title><?= htmlspecialchars($producto['nombre'] ?? 'Producto no encontrado') ?></title>

    <meta name="description" content="Detalles del producto" />
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ADLaM+Display&amp;display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=AR+One+Sans&amp;display=swap" />
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/fonts/simple-line-icons.min.css" />
    <link rel="stylesheet" href="../assets/css/bs-theme-overrides.css" />
    <link rel="stylesheet" href="../assets/css/baguetteBox.min.css" />
    <link rel="stylesheet" href="../assets/css/dark_navbar.css" />

    <style>
        .product-gallery {
            margin-bottom: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .main-image-container {
            height: 400px;
            width: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .main-image {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .thumbnail {
            height: 80px;
            width: 80px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .thumbnail:hover,
        .thumbnail.active {
            border-color: #587a2e;
            transform: scale(1.05);
        }

        .product-info {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            height: 400px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .back-button {
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            transform: translateX(-5px);
        }
    </style>
</head>

<body style="background: #abba87">

    <main class="page">
        <section class="clean-block" style="background: #d9dcbd; padding: 20px 0;">
            <div class="container">
                <a href="javascript:history.back()" class="btn btn-outline-success back-button">
                    <i class="fa fa-arrow-left"></i> Volver al catálogo
                </a>

                <?php if ($producto): ?>
                    <div class="block-heading">
                        <h2 style="color: #587a2e; font-family: 'ADLaM Display', serif;">
                            <?= htmlspecialchars($producto['nombre']) ?>
                        </h2>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <div class="container py-5" style="background: #abba87;">
        <?php if ($producto): ?>
            <div class="row align-items-stretch">
                <!-- Galería de imágenes -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="product-gallery">
                        <!-- Imagen principal -->
                        <div class="main-image-container">
                            <?php if (!empty($imagenes)): ?>
                                <?php
                                $imagenPrincipal = IMG_BASE_URL . basename($imagenes[0]['ruta_imagen']);
                                ?>
                                <img id="mainImage" src="<?= $imagenPrincipal ?>" class="main-image"
                                    alt="<?= htmlspecialchars($producto['nombre']) ?>"
                                    onerror="this.onerror=null; this.src='<?= IMG_DEFAULT ?>';">
                            <?php else: ?>
                                <img id="mainImage" src="<?= IMG_DEFAULT ?>" class="main-image" alt="Imagen no disponible">
                            <?php endif; ?>
                        </div>

                        <!-- Miniaturas -->
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <?php foreach ($imagenes as $index => $imagen): ?>
                                <?php
                                $imagenThumb = IMG_BASE_URL . basename($imagen['ruta_imagen']);
                                ?>
                                <img src="<?= $imagenThumb ?>" class="thumbnail <?= $index === 0 ? 'active' : '' ?>"
                                    onclick="changeImage(this, '<?= $imagenThumb ?>')" alt="Miniatura <?= $index + 1 ?>"
                                    onerror="this.onerror=null; this.src='<?= IMG_DEFAULT ?>';">
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Información del producto -->
                <div class="col-md-6">
                    <div class="product-info">
                        <h3 class="mb-3"><?= htmlspecialchars($producto['nombre']) ?></h3>

                        <div class="mb-3">
                            <span class="badge bg-success"><?= htmlspecialchars($producto['categoria']) ?></span>
                        </div>

                        <h4 class="text-success mb-3">$<?= number_format($producto['precio'], 2) ?></h4>

                        <div class="mb-4">
                            <h5>Descripción:</h5>
                            <p class="text-muted"><?= nl2br(htmlspecialchars($producto['descripcion'])) ?></p>
                        </div>

                        <?php if (!empty($producto['especificaciones'])): ?>
                            <div class="mb-4">
                                <h5>Especificaciones</h5>
                                <p class="text-muted"><?= nl2br(htmlspecialchars($producto['especificaciones'])) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger text-center">
                <h4>Producto no encontrado</h4>
                <p>El producto que buscas no está disponible o no existe.</p>
                <a href="/Views/Categorias/categoria_prod.php" class="btn btn-outline-success">Volver al catálogo</a>
            </div>
        <?php endif; ?>
    </div>


    <!-- inicia footer -->
    <?php include '../../Views/Paginas Principales/footer_principal.php'; ?>
    <!-- termina footer -->

    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/baguetteBox.min.js"></script>

    <script>
        // Cambiar imagen principal al hacer clic en miniatura
        function changeImage(element, newSrc) {
            document.getElementById('mainImage').src = newSrc;

            // Remover clase 'active' de todas las miniaturas
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });

            // Agregar clase 'active' a la miniatura clickeada
            element.classList.add('active');
        }

        // Actualizar cantidad
        function updateQuantity(change) {
            const quantityInput = document.getElementById('quantity');
            let newValue = parseInt(quantityInput.value) + change;

            if (newValue < 1) newValue = 1;

            quantityInput.value = newValue;
        }

        // Inicializar lightbox para la galería de imágenes
        baguetteBox.run('.product-gallery');
    </script>
</body>

</html>