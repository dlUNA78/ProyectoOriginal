<?php
include '..\..\config\database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
    $busqueda = $_POST['query'];
    $stmt = $conn->prepare("SELECT id AS id_producto, nombre, precio FROM productos WHERE nombre LIKE ?");
    $like = "%$busqueda%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    $datos = [];
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }

    echo json_encode($datos);
    exit;
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  $("#search").keyup(function () {
    let query = $(this).val().trim();

    if (query.length >= 2) {
      $.ajax({
        url: "buscar_producto.php", // Ruta del archivo PHP
        method: "POST",
        data: { query: query },
        success: function (data) {
          let productos = JSON.parse(data);
          let sugerencias = "";

          if (productos.length > 0) {
            productos.forEach(function (producto) {
              sugerencias += `<button type="button" class="list-group-item list-group-item-action sugerencia-item"
                            data-id="${producto.id_producto}"
                            data-nombre="${producto.nombre}"
                            data-precio="${producto.precio}">
                            ${producto.nombre}
                          </button>`;
            });
            $("#sugerencias").html(sugerencias).show();
          } else {
            $("#sugerencias").html('<div class="list-group-item">No se encontraron resultados</div>').show();
          }
        },
        error: function (xhr, status, error) {
          console.error("Error en la solicitud AJAX:", error);
        },
      });
    } else {
      $("#sugerencias").hide();
    }
  });

  // Manejar la selección de un producto de las sugerencias
  $(document).on("click", ".sugerencia-item", function () {
    let id = $(this).data("id");
    let nombre = $(this).data("nombre");
    let precio = $(this).data("precio");

    $("#search").val(nombre); // Rellenar el campo de búsqueda con el nombre seleccionado
    $("#precio").val(precio); // Rellenar el precio del producto
    $("#sugerencias").hide(); // Ocultar las sugerencias
  });
});
</script>

<div class="mb-3">
  <label class="form-label" style="color: rgb(0, 0, 0)">Precio Normal:</label>
  <input id="precio" class="form-control" type="text" readonly name="precio_normal" />
  <div id="errorsProduct" class="text-danger"></div>
</div>
