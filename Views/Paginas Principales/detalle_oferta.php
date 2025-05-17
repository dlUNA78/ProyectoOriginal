<!DOCTYPE html>
<html data-bs-theme="light" lang="es" style="background: #abba87">
<?php
include '../../Views/Paginas Principales/menu_principal.php';
include '../../config/database.php';

// Obtener el ID de la oferta desde la URL
$id_oferta = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consulta para obtener detalles de la oferta con información del producto asociado
$stmt = $conn->prepare("
    SELECT o.*, p.nombre AS nombre_producto, p.precio AS precio_producto, c.nombre AS categoria
    FROM ofertas o
    JOIN productos p ON o.id_producto = p.id
    JOIN categorias c ON p.id_categoria = c.id
    WHERE o.id_oferta = ?
");
$stmt->bind_param("i", $id_oferta);
$stmt->execute();
$oferta = $stmt->get_result()->fetch_assoc();

if (!$oferta) {
    // Si no existe la oferta, mostrar mensaje
    $mensaje_error = "Oferta no encontrada o no disponible.";
}

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
        .offer-image {
            width: 400px;
            height: 400px;
            object-fit: contain;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .offer-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            height: 400px;

        }

        .back-button {
            margin-bottom: 20px;
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

                <?php if ($oferta): ?>
                    <div class="block-heading">
                        <h2 style="color: #587a2e; font-family: 'ADLaM Display', serif;">
                            <?= htmlspecialchars($oferta['Nombre_oferta']) ?>
                        </h2>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger text-center">
                        <h4><?= $mensaje_error ?></h4>
                        <a href="/Views/Categorias/categoria_prod.php" class="btn btn-outline-success">Volver al
                            catálogo</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <div class="container py-5" style="background: #abba87;">
        <?php if ($oferta): ?>
            <div class="row">
                <!-- Imagen de la oferta -->

                <?php
                // Obtener la ruta relativa de la imagen desde la base de datos
                $imagen_relativa = isset($oferta['imagen']) ? ltrim($oferta['imagen'], '/') : '';
                $absolute_image_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $imagen_relativa;
                $web_image_path = '/' . $imagen_relativa;

                // Si la imagen no existe o está vacía, usar la imagen por defecto
                if (!file_exists($absolute_image_path) || empty($oferta['imagen'])) {
                    $web_image_path = '/assets/img/default-product.jpg';
                }
                ?>
                <div class="col-md-6 text-center">
                    <img src="<?= htmlspecialchars($web_image_path) ?>"
                        alt="<?= htmlspecialchars($oferta['Nombre_oferta']) ?>" class="offer-image"
                        onerror="this.onerror=null;this.src='/assets/img/default-product.jpg'">
                </div>

                <!-- Información de la oferta -->
                <div class="col-md-6">
                    <div class="offer-info">
                        <h3 class="mb-3"><?= htmlspecialchars($oferta['Nombre_oferta']) ?></h3>

                        <div class="mb-3">
                            <span class="badge bg-success"><?= htmlspecialchars($oferta['categoria']) ?></span>
                        </div>

                        <h4>
                            <del class="text-muted">$<?= number_format($oferta['precio_producto'], 2) ?></del>
                            <span class="text-danger">$<?= number_format($oferta['precio_oferta'], 2) ?></span>
                        </h4>

                        <div class="mb-3">
                            <strong>Vigencia:</strong> <?= date('d/m/Y', strtotime($oferta['Fecha_inicio'])) ?> -
                            <?= date('d/m/Y', strtotime($oferta['Fecha_expirada'])) ?>
                        </div>

                        <div class="mb-4">
                            <h5>Descripción de la oferta:</h5>
                            <p><?= nl2br(htmlspecialchars($oferta['descripcion'])) ?></p>
                        </div>

                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- inicia footer -->
    <?php include '../../Views/Paginas Principales/footer_principal.php'; ?>
    <!-- termina footer -->

    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>