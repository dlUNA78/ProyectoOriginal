document.getElementById("btnAgregar").addEventListener("click", function () {
  // Obtén los valores de los campos
  const nombre = document.getElementById("nombre").value;
  const precio = document.getElementById("precio").value;
  const categoria = document.getElementById("categoria").value;
  const descripcion = document.getElementById("descripcion").value;

  // Limpia los mensajes de error previos
  document.getElementById("errorNombre").innerText = "";
  document.getElementById("errorPrecio").innerText = "";

  // Validación de campos
  let isValid = true;

  if (nombre === "") {
    document.getElementById("errorNombre").innerText =
      "Por favor, completa este campo.";
    isValid = false;
  }
  if(precio === ""){
    document.getElementById("errorPrecio").innerText =
      "Llene este campo";
    isValid = false;
  }
  else if(isNaN(precio) || precio <= 0) {
    document.getElementById("errorPrecio").innerText =
      "El precio debe ser un número válido";
    isValid = false;
  }

  if (categoria === "") {
    document.getElementById("errorCategoria").innerText =
      "Por favor, selecciona una categoría.";
    isValid = false;
  }

  if (descripcion === "") {
    document.getElementById("errorDescripcion").innerText =
      "Por favor, completa este campo.";
    isValid = false;
  }

  if (isValid) {
    // Si los campos son válidos, abre el modal
    const modal = new bootstrap.Modal(document.getElementById("modal_confirm"));
    modal.show();
    document.getElementById("nombre").value = "";
    document.getElementById("precio").value = "";
    document.getElementById("categoria").value = "";
    document.getElementById("descripcion").value = "";
  }
});

document
  .getElementById("precio")
  .addEventListener("keypress", function (event) {
    const input = event.target.value;
    const dotCount = (input.match(/\./g) || []).length;

    if (!/[0-9.]/.test(event.key) || (event.key === "." && dotCount >= 1)) {
      event.preventDefault();
    }
  });
document
  .getElementById("nombre")
  .addEventListener("keypress", function (event) {
    if (!/^[a-zA-Z\s]*$/.test(event.key)) {
      event.preventDefault();
    }
  });
document
  .getElementById("precio")
  .addEventListener("keypress", function (event) {
    const input = event.target.value;
    const dotIndex = input.indexOf(".");

    if (
      dotIndex !== -1 &&
      input.length - dotIndex > 2 &&
      event.key !== "Backspace"
    ) {
      event.preventDefault();
    }
  });

document
  .getElementById("descripcion")
  .addEventListener("keypress", function (event) {
    if (!/^[a-zA-Z0-9\s]*$/.test(event.key)) {
      event.preventDefault();
    }
  });

//Codigo America

const products = [
  {
    id: 1,
    nombre: "Extractor",
    precio: 10,
    categoria: "Hogar",
    descripcion:
      "Extractor de jugos manual de gran tamaño, diseñado para obtener jugo de cítricos como naranjas, toronjas y limones con facilidad y eficiencia.",
  },
  {
    id: 2,
    nombre: "Pila de Auto",
    precio: 20,
    categoria: "Hogar",
    descripcion:
      "Batería de 12 voltios, marca LTH, diseñada para ofrecer alta potencia y rendimiento confiable en vehículos automotores.",
  },
  {
    id: 3,
    nombre: "Juego de piedras",
    precio: 5,
    categoria: "Hogar",
    descripcion:
      "Juego de piedras de 4 pulgadas fabricadas en piedra volcánica, ideales para moler maíz y otros granos. Su material garantiza un molido fino y homogéneo.",
  },
  {
    id: 4,
    nombre: "Molino eléctrico",
    precio: 50,
    categoria: "Hogar",
    descripcion:
      "Es un molino eléctrico de granos, motor de 25 HP, ideal para moler diferentes tipos de granos como maíz, trigo, café y especias. Diseñado para ofrecer un molido uniforme y eficiente.",
  },
  {
    id: 5,
    nombre: "Plaguicida",
    precio: 15,
    categoria: "Hogar",
    descripcion:
      "Plaguicida líquido en presentación de atomizador, especialmente formulado para eliminar cucarachas y otras plagas domésticas de manera rápida y efectiva.",
  },
];


//////


// Obtener referencias a los elementos del formulario
const selectProducto = document.getElementById("selectProducto");
const inputNombre = document.getElementById("nombre");
const inputPrecio = document.getElementById("precio");
const inputDescripcion = document.getElementById("descripcion");
const selectCategoria = document.getElementById("categoria");

// 🔹 Función para llenar el formulario con los datos de un producto
function llenarFormulario(producto) {
  inputNombre.value = producto.nombre;
  inputPrecio.value = producto.precio;
  inputDescripcion.value = producto.descripcion;
  selectCategoria.value = producto.categoria;
}

// 🔹 Llenar el `<select>` con los productos disponibles
products.forEach((producto) => {
  const option = document.createElement("option");
  option.value = producto.id;
  option.textContent = producto.nombre;
  selectProducto.appendChild(option);
});

// 🔹 Precargar el producto inicial desde la URL (si existe)
const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get("id");
const product = products.find((p) => p.id == productId);

// Si se encontró un producto, precargarlo
if (product) {
  llenarFormulario(product);
  selectProducto.value = product.id;
}

// 🔹 Evento para cambiar de producto al seleccionar otro en el `<select>`
selectProducto.addEventListener("change", function () {
  const selectedId = parseInt(selectProducto.value);
  const newProduct = products.find((p) => p.id === selectedId);
  
  if (newProduct) {
    llenarFormulario(newProduct);
  }
});



//este codigo es el que tenia ya 
// Obtener el ID del producto desde la URL
//const urlParams = new URLSearchParams(window.location.search);
//const productId = urlParams.get("id");

// Buscar el producto en el array
//const product = products.find((p) => p.id == productId);

//if (product) {
  // Precargar los datos en los inputs
//  document.getElementById("nombre").value = product.nombre;
//  document.getElementById("precio").value = product.precio;
//  document.getElementById("descripcion").value = product.descripcion;

  // Precargar la categoría en el select
//  const categoriaSelect = document.getElementById("categoria");
//  const optionToSelect = [...categoriaSelect.options].find(
//    (option) => option.value === product.categoria
//  );

//  if (optionToSelect) {
//    optionToSelect.selected = true;
//  }
//} else {
//  console.error("Producto no encontrado");
//}
