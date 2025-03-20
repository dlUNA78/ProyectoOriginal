document.getElementById('btnAgregar').addEventListener('click', function(event) {
    event.preventDefault();

    const nombre = document.getElementById('nombre').value.trim();
    const errorCategoria = document.getElementById('errorCategoria');

    errorCategoria.innerText = "";
    
    let isValid = true;

    if (nombre === "") {
        errorCategoria.innerText = "Ingrese un nombre";
        isValid = false;
    } else if (nombre.length < 3) {
        errorCategoria.innerText = "El nombre debe tener al menos 3 caracteres.";
        isValid = false;
    } else if (nombre.length > 50) {
        errorCategoria.innerText = "El nombre no debe superar los 50 caracteres.";
        isValid = false;
    } else if (!/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ]+$/.test(nombre)) {
        errorCategoria.innerText = "El nombre solo puede contener letras, y espacios.";
        isValid = false;
    }

    if (isValid) {
        const modal = new bootstrap.Modal(document.getElementById('Agregado'));
        modal.show();
    }
});