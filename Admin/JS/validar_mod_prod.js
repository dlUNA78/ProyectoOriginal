

// Simulación de la lista de productos
const products = [
  {
    id: 1,
    nombre: "Extractor",
    precio: 10,
    categoria: "Hogar",
    descripcion: "Extractor de jugos manual de gran tamaño, diseñado para obtener jugo de cítricos como naranjas, toronjas y limones con facilidad y eficiencia.",
  },
  {
    id: 2,
    nombre: "Pila de Auto",
    precio: 20,
    categoria: "Hogar",
    descripcion: "Batería de 12 voltios, marca LTH, diseñada para ofrecer alta potencia y rendimiento confiable en vehículos automotores.",
  },
  {
    id: 3,
    nombre: "Juego de piedras",
    precio: 5,
    categoria: "Hogar",
    descripcion: "Juego de piedras de 4 pulgadas fabricadas en piedra volcánica, ideales para moler maíz y otros granos. Su material garantiza un molido fino y homogéneo.",
  },
  {
    id: 4,
    nombre: "Molino eléctrico",
    precio: 50,
    categoria: "Hogar",
    descripcion: "Es un molino eléctrico de granos, motor de 25 HP, ideal para moler diferentes tipos de granos como maíz, trigo, café y especias. Diseñado para ofrecer un molido uniforme y eficiente.",
  },
  {
    id: 5,
    nombre: "Plaguicida",
    precio: 15,
    categoria: "Hogar",
    descripcion: "Plaguicida líquido en presentación de atomizador, especialmente formulado para eliminar cucarachas y otras plagas domésticas de manera rápida y efectiva.",
  },
];

// Obtener el elemento <select> de la lista desplegable
const listaDesplegable = document.getElementById("lista-desplegable");

// Llenar la lista desplegable con los nombres de los productos
products.forEach(producto => {
  const option = document.createElement("option");
  option.value = producto.id; // El valor de la opción será el ID del producto
  option.textContent = producto.nombre; // El texto visible será el nombre del producto
  listaDesplegable.appendChild(option);
});

// Manejar el evento "change" de la lista desplegable
listaDesplegable.addEventListener("change", function (event) {
  const selectedProductId = event.target.value; // Obtener el ID del producto seleccionado
  const selectedProduct = products.find(p => p.id == selectedProductId); // Buscar el producto en la lista

  if (selectedProduct) {
    // Rellenar el formulario con los detalles del producto seleccionado
    document.getElementById("nombre").value = selectedProduct.nombre;
    document.getElementById("precio").value = selectedProduct.precio;
    document.getElementById("categoria").value = selectedProduct.categoria;
    document.getElementById("descripcion").value = selectedProduct.descripcion;
  }
});

// Manejar el evento "click" del botón "Modificar"
document.getElementById("btnAgregar").addEventListener("click", function () {
  // Obtener los valores del formulario
  const nombre = document.getElementById("nombre").value;
  const precio = document.getElementById("precio").value;
  const categoria = document.getElementById("categoria").value;
  const descripcion = document.getElementById("descripcion").value;

  // Validar los campos
  let isValid = true;

  if (nombre === "") {
    document.getElementById("errorNombre").innerText = "Por favor, completa este campo.";
    isValid = false;
  }
  if (precio === "") {
    document.getElementById("errorPrecio").innerText = "Llene este campo";
    isValid = false;
  } else if (isNaN(precio) || precio <= 0) {
    document.getElementById("errorPrecio").innerText = "El precio debe ser un número válido";
    isValid = false;
  }
  if (categoria === "") {
    document.getElementById("errorCategoria").innerText = "Por favor, selecciona una categoría.";
    isValid = false;
  }
  if (descripcion === "") {
    document.getElementById("errorDescripcion").innerText = "Por favor, completa este campo.";
    isValid = false;
  }

  if (isValid) {
    // Obtener el ID del producto seleccionado
    const selectedProductId = listaDesplegable.value;

    // Buscar el producto en la lista
    const productIndex = products.findIndex(p => p.id == selectedProductId);

    if (productIndex !== -1) {
      // Actualizar el producto con los nuevos valores
      products[productIndex] = {
        id: products[productIndex].id, // Mantener el mismo ID
        nombre: nombre,
        precio: parseFloat(precio), // Convertir el precio a número
        categoria: categoria,
        descripcion: descripcion,
      };

      // Mostrar el modal de confirmación
      const modal = new bootstrap.Modal(document.getElementById("modal_confirm"));
      modal.show();

      // Limpiar el formulario
      document.getElementById("nombre").value = "";
      document.getElementById("precio").value = "";
      document.getElementById("categoria").value = "";
      document.getElementById("descripcion").value = "";

      // Redirigir al usuario a la página de productos después de cerrar el modal
      document.querySelector("#modal_confirm .btn-light").addEventListener("click", function () {
        window.location.href = "../Menú/products.html";
      });
    } else {
      console.error("Producto no encontrado");
    }
  }
});