document.addEventListener('DOMContentLoaded', function () {
    console.log("El DOM ha sido cargado correctamente.");

    // Simulación de datos de categorías (esto debería ser reemplazado por una solicitud real al servidor)
    const categorias = [
        { id: 1, nombre: 'Tv Satelital' },
        { id: 2, nombre: 'Radiocomunicación' },
        { id: 3, nombre: 'Hogar' },
        { id: 4, nombre: 'Plaguicidas' },
        { id: 5, nombre: 'Energía Solar' }
    ];

    console.log("Categorías cargadas:", categorias);

    // Obtener el elemento <select> de la lista desplegable
    const listaDesplegable = document.getElementById('lista-desplegable');

    if (listaDesplegable) {
        // Limpiar el <select> antes de llenarlo (opcional)
        listaDesplegable.innerHTML = '<option value="">Selecciona una categoría</option>';

        // Llenar el <select> con las categorías
        categorias.forEach(categoria => {
            const option = document.createElement('option');
            option.value = categoria.id;
            option.textContent = categoria.nombre;
            listaDesplegable.appendChild(option);
        });

        console.log("Categorías agregadas al <select>.");
    } else {
        console.error("No se encontró el elemento con ID 'lista-desplegable'.");
    }

    // Evento para cargar la información de la categoría seleccionada
    listaDesplegable.addEventListener('change', function () {
        const categoriaId = this.value;
        const categoriaSeleccionada = categorias.find(cat => cat.id == categoriaId);

        if (categoriaSeleccionada) {
            document.getElementById('nombre').value = categoriaSeleccionada.nombre;
        } else {
            document.getElementById('nombre').value = '';
        }
    });

    // Validación del formulario
    document.getElementById('btnAgregar').addEventListener('click', function (event) {
        event.preventDefault();

        const nombre = document.getElementById('nombre').value;
        const categoriaSeleccionada = document.getElementById('lista-desplegable').value;

        document.getElementById('errorCategoria').innerText = "";

        let isValid = true;

        if (nombre === "") {
            document.getElementById('errorCategoria').innerText = "Por favor, completa este campo.";
            isValid = false;
        }

        if (isValid) {
            console.log("Formulario válido. Categoría seleccionada:", categoriaSeleccionada);
            console.log("Nuevo nombre:", nombre);

            // Mostrar el modal
            const modal = new bootstrap.Modal(document.getElementById('modal-1'));
            modal.show();
        }
    });
});

