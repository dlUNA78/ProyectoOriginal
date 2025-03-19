// modify_offer.js
document.addEventListener('DOMContentLoaded', function () {
    // Deshabilitar campos
    document.getElementById("precioBe").disabled = true;
    document.getElementById("nombre").disabled = true;
    document.getElementById("descripcion").disabled = true;
  
    // Precargar valores en el formulario
    const nombre = localStorage.getItem('nombre');
    const descripcion = localStorage.getItem('descripcion');
    const precio = localStorage.getItem('precio');
    const precioDescuento = localStorage.getItem('precioDescuento');
    const imagen = localStorage.getItem('imagen');
  
    if (nombre && descripcion && precio && precioDescuento && imagen) {
      document.getElementById('nombre').value = nombre;
      document.getElementById('descripcion').value = descripcion;
      document.getElementById('precioBe').value = precio;
      document.getElementById('precioNew').value = precioDescuento;
    }
  
    // Limpiar localStorage después de usar los valores
    localStorage.removeItem('nombre');
    localStorage.removeItem('descripcion');
    localStorage.removeItem('precio');
    localStorage.removeItem('precioDescuento');
    localStorage.removeItem('imagen');
  
    // Validación del campo "Nuevo Precio"
    document.getElementById("btn_agregar").addEventListener("click", function (event) {
      event.preventDefault();
  
      const precioNew = document.getElementById("precioNew").value;
      let isValid = true;
  
      if (precioNew === "") {
        document.getElementById("errorPrecioNew").innerText = "El campo no puede estar vacío";
        isValid = false;
      } else if (precioNew <= 0) {
        document.getElementById("errorPrecioNew").innerText = "El nuevo precio debe ser un número válido";
        isValid = false;
      }
  
      if (isValid) {
        const modal = new bootstrap.Modal(document.getElementById("modal-1"));
        modal.show();
      }
    });
  
    // Validar que solo se ingresen números y un punto decimal
    document.getElementById("precioNew").addEventListener("keypress", function (event) {
      if (!/[0-9.]/.test(event.key)) {
        event.preventDefault();
      }
    });
  
    // Limitar a dos decimales
    document.getElementById("precioNew").addEventListener("input", function (event) {
      const value = event.target.value;
      if (value.includes(".")) {
        const decimalPart = value.split(".")[1];
        if (decimalPart.length > 2) {
          event.target.value = value.slice(0, value.length - 1);
        }
      }
    });
  });






