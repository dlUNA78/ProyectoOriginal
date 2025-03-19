document.getElementById('btnAgregar').addEventListener('click', function(event) {
    event.preventDefault();

    const nombre = document.getElementById('nombre').value;
    

    document.getElementById('errorCategoria').innerText = "";
    

    let isValid = true;

    if (nombre === "") {
        document.getElementById('errorCategoria').innerText = "Por favor, completa este campo.";
        isValid = false;
    }

    if (isValid) {
        const modal = new bootstrap.Modal(document.getElementById('modal-1'));
        modal.show();
    }
});