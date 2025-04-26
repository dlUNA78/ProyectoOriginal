<!DOCTYPE html>
<html data-bs-theme="light" lang="es" style="background: #abba87">
<?php
include '../../Views/Paginas Principales/menu_principal.php';
include '../../config/database.php';

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuración de rutas
define('BASE_DIR', realpath(__DIR__ . '/../../'));
define('BASE_URL', '../');
define('IMG_DEFAULT', '../admin/assets/img/productos/default.jpg');

// Manejar acciones del carrito
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            if (isset($_GET['id']) && isset($_GET['quantity'])) {
                $id = intval($_GET['id']);
                $quantity = intval($_GET['quantity']);
                
                // Obtener información del producto
                $stmt = $conn->prepare("SELECT id, nombre, precio FROM productos WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $producto = $stmt->get_result()->fetch_assoc();
                
                if ($producto) {
                    if (!isset($_SESSION['carrito'])) {
                        $_SESSION['carrito'] = [];
                    }
                    
                    // Si el producto ya está en el carrito, actualizar cantidad
                    if (isset($_SESSION['carrito'][$id])) {
                        $_SESSION['carrito'][$id]['quantity'] += $quantity;
                    } else {
                        $_SESSION['carrito'][$id] = [
                            'id' => $producto['id'],
                            'nombre' => $producto['nombre'],
                            'precio' => $producto['precio'],
                            'quantity' => $quantity
                        ];
                    }
                    
                    // Redirigir para evitar reenvío del formulario
                    header("Location: carrito.php");
                    exit();
                }
            }
            break;
            
        case 'update':
            if (isset($_POST['update_cart'])) {
                foreach ($_POST['quantity'] as $id => $quantity) {
                    $id = intval($id);
                    $quantity = intval($quantity);
                    
                    if ($quantity > 0 && isset($_SESSION['carrito'][$id])) {
                        $_SESSION['carrito'][$id]['quantity'] = $quantity;
                    } elseif ($quantity <= 0 && isset($_SESSION['carrito'][$id])) {
                        unset($_SESSION['carrito'][$id]);
                    }
                }
                
                // Redirigir para evitar reenvío del formulario
                header("Location: carrito.php");
                exit();
            }
            break;
            
        case 'remove':
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                if (isset($_SESSION['carrito'][$id])) {
                    unset($_SESSION['carrito'][$id]);
                }
                
                // Redirigir para evitar reenvío del formulario
                header("Location: carrito.php");
                exit();
            }
            break;
            
        case 'clear':
            unset($_SESSION['carrito']);
            header("Location: carrito.php");
            exit();
            break;
    }
}

// Calcular totales
$subtotal = 0;
$total_items = 0;

if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $item) {
        $subtotal += $item['precio'] * $item['quantity'];
        $total_items += $item['quantity'];
    }
}

// Supongamos un impuesto del 16% (IVA)
$impuesto = $subtotal * 0.16;
$total = $subtotal + $impuesto;
?>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>Carrito de Compras</title>
  
  <meta name="description" content="Carrito de compras" />
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ADLaM+Display&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=AR+One+Sans&amp;display=swap" />
  <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css" />
  <link rel="stylesheet" href="../assets/fonts/simple-line-icons.min.css" />
  <link rel="stylesheet" href="../assets/css/bs-theme-overrides.css" />
  <link rel="stylesheet" href="../assets/css/dark_navbar.css" />
  
  <style>
    .cart-container {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
    }
    .cart-item {
      border-bottom: 1px solid #dee2e6;
      padding: 15px 0;
    }
    .cart-item:last-child {
      border-bottom: none;
    }
    .product-image {
      width: 80px;
      height: 80px;
      object-fit: contain;
      border-radius: 5px;
    }
    .quantity-input {
      width: 60px;
      text-align: center;
    }
    .summary-card {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 20px;
    }
    .empty-cart {
      text-align: center;
      padding: 50px 0;
    }
    .btn-checkout {
      background: #587a2e;
      color: white;
      font-weight: bold;
    }
    .btn-checkout:hover {
      background: #3e5a1f;
      color: white;
    }
  </style>
</head>

<body style="background: #abba87">

  <main class="page">
    <section class="clean-block" style="background: #d9dcbd; padding: 20px 0;">
      <div class="container">
        <div class="block-heading">
          <h2 style="color: #587a2e; font-family: 'ADLaM Display', serif;">
            <i class="icon-basket-loaded"></i> Carrito de Compras
          </h2>
          <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
            <p class="text-muted">Tienes <?= $total_items ?> producto(s) en tu carrito</p>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

  <div class="container py-5" style="background: #abba87;">
    <div class="row">
      <!-- Lista de productos -->
      <div class="col-lg-8">
        <div class="cart-container">
          <?php if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])): ?>
            <form action="carrito.php?action=update" method="post">
              <?php foreach ($_SESSION['carrito'] as $id => $item): ?>
                <div class="cart-item row align-items-center">
                  <div class="col-md-2">
                    <?php 
                    // Obtener imagen del producto
                    $stmt_img = $conn->prepare("SELECT ruta_imagen FROM imagenes_producto WHERE id_producto = ? LIMIT 1");
                    $stmt_img->bind_param("i", $id);
                    $stmt_img->execute();
                    $imagen = $stmt_img->get_result()->fetch_assoc();
                    $imagenPath = $imagen ? "../" . htmlspecialchars($imagen['ruta_imagen']) : IMG_DEFAULT;
                    ?>
                    <img src="<?= $imagenPath ?>" alt="<?= htmlspecialchars($item['nombre']) ?>" 
                         class="product-image" onerror="this.onerror=null; this.src='<?= IMG_DEFAULT ?>';">
                  </div>
                  <div class="col-md-4">
                    <h5 class="mb-1"><?= htmlspecialchars($item['nombre']) ?></h5>
                    <p class="mb-1 text-success">$<?= number_format($item['precio'], 2) ?></p>
                  </div>
                  <div class="col-md-3">
                    <div class="input-group">
                      <input type="number" name="quantity[<?= $id ?>]" value="<?= $item['quantity'] ?>" 
                             min="1" class="form-control quantity-input">
                      <button type="submit" class="btn btn-outline-success">Actualizar</button>
                    </div>
                  </div>
                  <div class="col-md-2 text-end">
                    <p class="mb-0 fw-bold">$<?= number_format($item['precio'] * $item['quantity'], 2) ?></p>
                  </div>
                  <div class="col-md-1 text-end">
                    <a href="carrito.php?action=remove&id=<?= $id ?>" class="btn btn-outline-danger">
                      <i class="fa fa-trash"></i>
                    </a>
                  </div>
                </div>
              <?php endforeach; ?>
              
              <div class="d-flex justify-content-between mt-3">
                <a href="catalogo.php" class="btn btn-outline-secondary">
                  <i class="fa fa-arrow-left"></i> Seguir comprando
                </a>
                <div>
                  <button type="submit" name="update_cart" class="btn btn-outline-primary me-2">
                    <i class="fa fa-refresh"></i> Actualizar carrito
                  </button>
                  <a href="carrito.php?action=clear" class="btn btn-outline-danger">
                    <i class="fa fa-trash"></i> Vaciar carrito
                  </a>
                </div>
              </div>
            </form>
          <?php else: ?>
            <div class="empty-cart">
              <i class="fa fa-shopping-cart fa-5x text-muted mb-4"></i>
              <h3>Tu carrito está vacío</h3>
              <p class="text-muted mb-4">No has agregado ningún producto a tu carrito</p>
              <a href="/Views/Categorias/categoria_prod.php" class="btn btn-success">
                <i class="fa fa-arrow-left"></i> Ir al catálogo
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>
      
      <!-- Resumen del pedido -->
      <div class="col-lg-4">
        <?php if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])): ?>
          <div class="summary-card sticky-top" style="top: 20px;">
            <h4 class="mb-4">Resumen del pedido</h4>
            
            <div class="d-flex justify-content-between mb-2">
              <span>Subtotal (<?= $total_items ?> items):</span>
              <span>$<?= number_format($subtotal, 2) ?></span>
            </div>
            
            <div class="d-flex justify-content-between mb-2">
              <span>Impuestos (16%):</span>
              <span>$<?= number_format($impuesto, 2) ?></span>
            </div>
            
            <div class="d-flex justify-content-between mb-3 fw-bold fs-5">
              <span>Total:</span>
              <span>$<?= number_format($total, 2) ?></span>
            </div>
            
            <a href="checkout.php" class="btn btn-checkout btn-lg w-100 py-2">
              <i class="fa fa-credit-card"></i> Proceder al pago
            </a>
            
            <div class="mt-3 text-center">
              <small class="text-muted">O continúa con más compras</small><br>
              <a href="/Views/Categorias/categoria_prod.php" class="btn btn-outline-success mt-2">
                <i class="fa fa-shopping-basket"></i> Seguir comprando
              </a>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <footer class="text-center py-4" style="background: #d9dcbd; margin-top: 38px">
    <div class="container">
      <div class="row row-cols-1 row-cols-lg-3">
        <div class="col">
          <p class="my-2" style="font-size: 19px; color: rgb(88, 122, 46)">
            <i class="icon-location-pin" style="font-weight: bold; font-size: 25px"></i>&nbsp; AV. Álvaro obregón N.-
            1796
          </p>
        </div>
        <div class="col">
          <p class="my-2" style="font-size: 19px; color: rgb(88, 122, 46)">
            <i class="icon-screen-smartphone" style="
                  color: rgb(88, 122, 46);
                  font-size: 25px;
                  font-weight: bold;
                "></i>&nbsp; 453-537-06-03
          </p>
        </div>
        <div class="col">
          <p class="my-2" style="color: rgb(88, 122, 46); font-size: 19px">
            <i class="icon-envelope" style="
                  color: rgb(88, 122, 46);
                  font-size: 25px;
                  font-weight: bold;
                "></i>&nbsp; yesid_amale@hotmail.com
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <p class="my-2" style="font-size: 19px; color: rgb(88, 122, 46)">
            <strong>TECNM Campus Coalcomán Ingeniería en Sistemas Computacionales 6º Semestre-2025</strong>
          </p>
        </div>
      </div>
    </div>
  </footer>

  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  
  <script>
    // Validar cantidades antes de enviar el formulario
    document.addEventListener('DOMContentLoaded', function() {
      const quantityInputs = document.querySelectorAll('.quantity-input');
      
      quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
          if (this.value < 1) {
            this.value = 1;
          }
        });
      });
      
      // Mostrar confirmación al vaciar el carrito
      const clearCartBtn = document.querySelector('a[href*="action=clear"]');
      if (clearCartBtn) {
        clearCartBtn.addEventListener('click', function(e) {
          if (!confirm('¿Estás seguro de que deseas vaciar tu carrito?')) {
            e.preventDefault();
          }
        });
      }
    });
  </script>
</body>
</html>