<!DOCTYPE html>
<?php



session_start();

if (!isset($_SESSION['user'])) {
  header("Location:login.php");
  die();
}



//conexcion a la base de datos
include 'C:\Git\GitHub\ProyectoOriginal\ProyectoWeb-main\ProyectoWeb-main\ProyectoOriginal\config\database.php';
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" />
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
    include 'C:\Git\GitHub\ProyectoOriginal\ProyectoWeb-main\ProyectoWeb-main\ProyectoOriginal\Admin\Menú\menu.php';
    ?>
      <!-- Barra lateral de navegación -->
      

          <!-- Contenido principal -->
          <div class="col search-table-col" style="margin-top: 50px;">
            <h1 style="color: rgb(0, 0, 0); font-family: Alef, sans-serif; margin-left: 15px;">
              Productos
            </h1>

            <!-- Tabla de productos (mostrará solo 1 producto) -->
            <div class="table-responsive" style="margin: 0 50px;">
              <table class="table table-striped table-hover text-center table-bordered" id="tablaProductos">
                <thead class="bill-header cs">
                  <tr style="background: var(--bs-info);">
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Imágenes</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody style="text-align: center" id="cuerpoTabla">
                  <!-- Producto se cargará aquí -->
                </tbody>
              </table>
            </div>

            <div class="d-grid float-end">
              <a class="btn btn-primary" role="button" style="background: var(--bs-info); font-weight: bold; margin-right: 50px;"
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
      </div>
    </div>

    <!-- Scripts -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
      // Datos de ejemplo (en producción vendrían de una base de datos)
      const productos = [
        {
          id: 1,
          nombre: "Extractor",
          precio: "10",
          categoria: "Hogar",
          descripcion: "Extractor de jugos manual de gran tamaño, diseñado para obtener jugo de cítricos como naranjas, toronjas y limones con facilidad y eficiencia.",
          imagen: "../assets/img/clipboard-image-3.png"
        },
        {
          id: 2,
          nombre: "Panel Solar",
          precio: "250",
          categoria: "Energía Solar",
          descripcion: "Panel solar de 100W para generación de energía renovable.",
          imagen: "../assets/img/panel-solar.jpg"
        },
        {
          id: 3,
          nombre: "Antena TV",
          precio: "75",
          categoria: "Tv satelital",
          descripcion: "Antena parabólica para recepción de señal satelital.",
          imagen: "../assets/img/antena-tv.jpg"
        }
      ];

      <?php
      if($result->num_rows > 0 ){

        while($row = $result->fetch_assoc()){

      ?>
      // Función para mostrar un producto en la tabla
      function mostrarProducto(producto) {
        const cuerpoTabla = document.getElementById('cuerpoTabla');
        cuerpoTabla.innerHTML = `

          <tr>
            <td><?=$row['nombre'] ?></td>
            <td><?=$row['precio'] ?></td>
            <td><?=$row['id_categoria'] ?></td>
            <td><?=$row['descripcion'] ?></td>
            <td><img src="<?=$row['imagenes'] ?>" style="width: 75px; height: auto" /></td>
            <td>
              <a class="btn" role="button" style="margin-left: 5px; background: var(--bs-warning);"
                href="../Edición%20de%20Productos/modify_product.php?id=${producto.id}">
                <i class="far fa-edit" style="font-size: 15px; color: rgb(14, 14, 13)"></i>
              </a>
              <button class="btn btn-danger" style="margin-left: 5px" type="submit"
                      data-bs-target="#miModal" data-bs-toggle="modal">
                <i class="fa fa-trash" style="font-size: 15px"></i>
              </button>
            </td>
          </tr>
        `;
      }
      <?php
        }
      }else{
        echo "No hay productos disponibles.";
      }
      // Cerrar la conexión a la base de datos
        ?>

      // Función para buscar productos
      function buscarProducto() {
        const termino = $("#buscadorProductos").val().toLowerCase();
        const productoEncontrado = productos.find(p =>
          p.nombre.toLowerCase().includes(termino)
        );

        if (productoEncontrado) {
          mostrarProducto(productoEncontrado);
        } else {
          alert("Producto no encontrado");
        }
      }

      // Inicialización
      $(document).ready(function() {
        // Mostrar el primer producto al cargar
        mostrarProducto(productos[0]);

        // Configurar autocompletado
        $("#buscadorProductos").autocomplete({
          source: productos.map(p => p.nombre),
          minLength: 1,
          select: function(event, ui) {
            const producto = productos.find(p => p.nombre === ui.item.value);
            if (producto) mostrarProducto(producto);
          }
        });

        // Configurar eventos
        $("#btnBuscar").click(buscarProducto);
        $("#buscadorProductos").keypress(function(e) {
          if (e.which === 13) buscarProducto();
        });
      });
    </script>
  </body>
</html>
