<!DOCTYPE html>
<html data-bs-theme="light" lang="es" style="background: #abba87">
<?php
include '../../Views/Paginas Principales/menu_principal.php';
include '../../config/database.php';

// Obtener el ID de la oferta desde la URL
$id_oferta = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consulta para obtener los detalles de la oferta
$stmt = $conn->prepare("SELECT * FROM ofertas WHERE id_oferta = ?");
$stmt->bind_param("i", $id_oferta);
$stmt->execute();
$oferta = $stmt->get_result()->fetch_assoc();

// Configuración de rutas
define('BASE_DIR', realpath(__DIR__ . '/../../'));
define('BASE_URL', '../');
define('IMG_DEFAULT', '../admin/assets/img/productos/default.jpg');

// Ruta de la imagen
$absolute_image_path = "C:\\Users\\PC\\Documents\\GitHub\\ProyectoOriginal\\uploads\\ofertas\\" . $oferta['imagen'];
$web_image_path = "../uploads/ofertas/" . $oferta['imagen'];
if (!file_exists($absolute_image_path)) {
    $web_image_path = IMG_DEFAULT;
}

$descuento = round(($oferta['precio'] - $oferta['precio_oferta']) / $oferta['precio'] * 100);
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title><?= htmlspecialchars($oferta['Nombre_oferta'] ?? 'Oferta no encontrada') ?></title>

    <meta name="description" content="Detalles de la oferta" />
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
        }

        .main-image {
            height: 400px;
            object-fit: contain;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .thumbnail {
            height: 80px;
            width: 80px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 5px;
        }

        .thumbnail:hover,
        .thumbnail.active {
            border-color: #587a2e;
        }

        .product-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }

        .back-button {
            margin-bottom: 20px;
        }

        .discount-badge {
            font-size: 1.5rem;
            padding: 0.5rem 1rem;
        }
    </style>
</head>

<body style="background: #abba87">

    <main class="page">
        <section class="clean-block" style="background: #d9dcbd; padding: 20px 0;">
            <div class="container">
                <a href="javascript:history.back()" class="btn btn-outline-success back-button">
                    <i class="fa fa-arrow-left"></i> Volver a ofertas
                </a>

                <?php if ($oferta): ?>
                    <div class="block-heading">
                        <h2 style="color: #587a2e; font-family: 'ADLaM Display', serif;">
                            <?= htmlspecialchars($oferta['Nombre_oferta']) ?>
                        </h2>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <div class="container py-5" style="background: #abba87;">
        <?php if ($oferta): ?>
            <div class="row">
                <!-- Imagen de la oferta -->
                <div class="col-md-6">
                    <div class="product-gallery">
                        <div class="text-center mb-3">
                            <img id="mainImage" src="<?= $web_image_path ?>" class="img-fluid main-image"
                                alt="<?= htmlspecialchars($oferta['Nombre_oferta']) ?>"
                                onerror="this.onerror=null; this.src='<?= IMG_DEFAULT ?>';">
                        </div>
                    </div>
                </div>

                <!-- Información de la oferta -->
                <div class="col-md-6">
                    <div class="product-info">
                        <h3 class="mb-3"><?= htmlspecialchars($oferta['Nombre_oferta']) ?></h3>

                        <div class="mb-4">
                            <span class="badge bg-danger discount-badge">-<?= $descuento ?>%</span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted text-decoration-line-through me-3 fs-5">
                                $<?= number_format($oferta['precio'], 2) ?>
                            </span>
                            <span class="text-success fw-bold fs-2">
                                $<?= number_format($oferta['precio_oferta'], 2) ?>
                            </span>
                        </div>

                        <div class="mb-4">
                            <h5>Descripción:</h5>
                            <p><?= nl2br(htmlspecialchars($oferta['descripcion'] ?? 'Oferta especial por tiempo limitado')) ?>
                            </p>
                        </div>

                        <div class="mb-4">
                            <h5>Válido hasta:</h5>
                            <p><?= date('d/m/Y', strtotime($oferta['Fecha_expirada'])) ?></p>
                        </div>

                        <div class="d-flex gap-2">
                            <div class="input-group" style="width: 120px;">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="updateQuantity(-1)">-</button>
                                <input type="number" id="quantity" class="form-control text-center" value="1" min="1">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="updateQuantity(1)">+</button>
                            </div>
                            <button class="btn btn-success">
                                <i class="fa fa-cart-plus"></i> Añadir al carrito
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger text-center">
                <h4>Oferta no encontrada</h4>
                <p>La oferta que buscas no está disponible o no existe.</p>
                <a href="ofertas.php" class="btn btn-outline-success">Volver a ofertas</a>
            </div>
        <?php endif; ?>
    </div>


    <!-- inicia footer -->
    <?php include './footer_principal.php'; ?>
    <!-- termina footer -->


    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/baguetteBox.min.js"></script>

    <script>
        // Actualizar cantidad
        function updateQuantity(change) {
            const quantityInput = document.getElementById('quantity');
            let newValue = parseInt(quantityInput.value) + change;

            if (newValue < 1) newValue = 1;

            quantityInput.value = newValue;
        }

        // Inicializar lightbox para la imagen
        baguetteBox.run('.product-gallery');
    </script>
</body>

</html>