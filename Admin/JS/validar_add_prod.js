document.getElementById('btnAgregar').addEventListener('click', function() {
    // Obtén los valores de los campos
    const nombre = document.getElementById('nombre').value;
    const precio = document.getElementById('precio').value;
    const categoria = document.getElementById('categoria').value;

    // Limpia los mensajes de error previos
    document.getElementById('errorNombre').innerText = "";
    document.getElementById('errorPrecio').innerText = "";
    document.getElementById('errorCategoria').innerText = "";

    // Validación de campos
    let isValid = true;

    if (nombre === "") {
        document.getElementById('errorNombre').innerText = "Por favor, completa este campo.";
        isValid = false;
    }
    if (precio === "" || isNaN(precio) || precio <= 0) {
        document.getElementById('errorPrecio').innerText = "El precio debe ser un número válido";
        isValid = false;
    }
    

    if (isValid) {
        // Si los campos son válidos, abre el modal
        const modal = new bootstrap.Modal(document.getElementById('Agregado'));
        modal.show();
    }
});


document
  .getElementById("precio")
  .addEventListener("keypress", function (event) {
    const input = event.target.value;
    const dotCount = (input.match(/\./g) || []).length;

    if (!/[0-9.]/.test(event.key) || (event.key === '.' && dotCount >= 1)) {
      event.preventDefault();
    }
  });