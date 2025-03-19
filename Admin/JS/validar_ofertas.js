document.getElementById("sProducto").disabled = true;

document
  .getElementById("btn_agregar")
  .addEventListener("click", function (event) {
    event.preventDefault();

    const nombre = document.getElementById("nombre").value;
    const descuento = document.getElementById("descuento").value;
    const descripcion = document.getElementById("descripcion").value;
    const sProducto = document.getElementById("sProducto").value;

    document.getElementById("errorNombre").innerText = "";
    document.getElementById("errorDescuento").innerText = "";
    document.getElementById("errorDescripcion").innerText = "";
    document.getElementById("errorEstadoOferta").innerText = "";
    document.getElementById("errorsProduct").innerText = "";

    let isValid = true;

    if (nombre === "") {
      document.getElementById("errorNombre").innerText =
        "Por favor, completa este campo.";
      isValid = false;
    }
    if (descuento === "" || isNaN(descuento) || descuento <= 0) {
      document.getElementById("errorDescuento").innerText =
        "El descuento debe ser un número válido";
      isValid = false;
    }
    if (descripcion === "") {
      document.getElementById("errorDescripcion").innerText =
        "Ingrese una descripción";
      isValid = false;
    }
    if (sProducto === "") {
      document.getElementById("errorsProduct").innerText =
        "Ingrese un producto";
      isValid = false;
    }
    const estadoOfertaActivo = document.getElementById("formCheck-1").checked;
    const estadoOfertaInactivo = document.getElementById("formCheck-2").checked;

    if (!estadoOfertaActivo && !estadoOfertaInactivo) {
      document.getElementById("errorEstadoOferta").innerText =
        "Seleccione el estado de la oferta.";
      isValid = false;
    }
    if (isValid) {
      const modal = new bootstrap.Modal(document.getElementById("Agregado"));
      modal.show();
    }
  });

document
  .getElementById("existencia")
  .addEventListener("keypress", function (event) {
    if (!/[0-9.]/.test(event.key)) {
      event.preventDefault();
    }
  });
