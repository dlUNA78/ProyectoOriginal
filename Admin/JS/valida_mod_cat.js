document.addEventListener('DOMContentLoaded', function () {
    console.log("El DOM ha sido cargado correctamente.");

    // Simulación de datos de categorías
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
        listaDesplegable.innerHTML = '<option value="">Selecciona una categoría</option>';
        
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

        const nombre = document.getElementById('nombre').value.trim();
        const categoriaSeleccionada = document.getElementById('lista-desplegable').value;
        const errorCategoria = document.getElementById('errorCategoria');
        
        errorCategoria.innerText = "";
        let isValid = true;

        // Validación del nombre
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
            errorCategoria.innerText = "El nombre solo puede contener letras y espacios.";
            isValid = false;
        }

        // Validación de la categoría
        if (!categoriaSeleccionada || categoriaSeleccionada.trim() === "") {
            errorCategoria.innerText = "Por favor, selecciona una categoría.";
            isValid = false;
        }

        if (isValid) {
            console.log("Formulario válido. Categoría seleccionada:", categoriaSeleccionada);
            console.log("Nuevo nombre:", nombre);

            // Mostrar el modal de confirmación
            const modal = new bootstrap.Modal(document.getElementById('Agregado'));
            modal.show();
        }
         if (isValid) {
        const modal = new bootstrap.Modal(document.getElementById('Agregado'));
        modal.show();
    }
    
    });
});
