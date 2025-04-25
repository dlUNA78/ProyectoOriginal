document.addEventListener('DOMContentLoaded', function() {
  // Definir patrones regex (modificados para no permitir números)
  const REGEX_NOMBRE = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-\.\,\/]+$/;
  const REGEX_DESCRIPCION = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-\.\,\/\(\)]+$/;
  const REGEX_PRECIO = /^\d+(\.\d{1,2})?$/;
  const REGEX_IMAGEN = /\.(jpe?g|png|gif|webp)$/i;

  document.querySelector('form').addEventListener('submit', function(e) {
      // Obtén los valores de los campos
      const nombre = document.getElementById('nombre').value.trim();
      const descripcion = document.getElementById('descripcion').value.trim();
      const precio = document.getElementById('precio').value.trim();
      const categoria = document.getElementById('categoria').value;
      const imagenes = document.querySelector('input[type="file"]').files;

      // Limpia los mensajes de error previos
      document.getElementById('errorNombre').innerText = "";
      document.getElementById('errorDescripcion').innerText = "";
      document.getElementById('errorPrecio').innerText = "";
      document.getElementById('errorCategoria').innerText = "";
      document.getElementById('errorImagen').innerText = "";

      // Validación de campos
      let isValid = true;

      // Validar nombre (sin números)
      if (nombre === "") {
          document.getElementById('errorNombre').innerText = "El nombre es obligatorio";
          isValid = false;
      } else if (!REGEX_NOMBRE.test(nombre)) {
          document.getElementById('errorNombre').innerText = "El nombre solo debe contener letras y algunos símbolos (no números)";
          isValid = false;
      } else if (nombre.length < 3 || nombre.length > 50) {
          document.getElementById('errorNombre').innerText = "El nombre debe tener entre 3 y 50 caracteres";
          isValid = false;
      }

      // Validar descripción (sin números)
      if (descripcion === "") {
          document.getElementById('errorDescripcion').innerText = "La descripción es obligatoria";
          isValid = false;
      } else if (!REGEX_DESCRIPCION.test(descripcion)) {
          document.getElementById('errorDescripcion').innerText = "La descripción solo debe contener letras y algunos símbolos (no números)";
          isValid = false;
      } else if (descripcion.length < 10 || descripcion.length > 500) {
          document.getElementById('errorDescripcion').innerText = "La descripción debe tener entre 10 y 500 caracteres";
          isValid = false;
      }

      // Validar precio
      if (precio === "" || !REGEX_PRECIO.test(precio) || parseFloat(precio) <= 0) {
          document.getElementById('errorPrecio').innerText = "El precio debe ser un número positivo con hasta 2 decimales";
          isValid = false;
      }

      // Validar categoría
      if (categoria === "" || isNaN(categoria)) {
          document.getElementById('errorCategoria').innerText = "Seleccione una categoría válida";
          isValid = false;
      }

      // Validar imágenes (si se subieron)
      if (imagenes.length > 0) {
          for (let i = 0; i < imagenes.length; i++) {
              if (!REGEX_IMAGEN.test(imagenes[i].name)) {
                  document.getElementById('errorImagen').innerText = "Solo se permiten imágenes JPG, PNG, GIF o WEBP";
                  isValid = false;
                  break;
              }
              
              if (imagenes[i].size > 5242880) {
                  document.getElementById('errorImagen').innerText = "Las imágenes no deben exceder 5MB";
                  isValid = false;
                  break;
              }
          }
      }

      if (!isValid) {
          e.preventDefault();
      }
  });

  // Validación en tiempo real para nombre (no permitir números)
  document.getElementById('nombre').addEventListener('input', function(e) {
      const input = e.target.value;
      if (/[0-9]/.test(input)) {
          e.target.value = input.replace(/[0-9]/g, '');
          document.getElementById('errorNombre').innerText = "No se permiten números en este campo";
      } else {
          document.getElementById('errorNombre').innerText = "";
      }
  });

  // Validación en tiempo real para descripción (no permitir números)
  document.getElementById('descripcion').addEventListener('input', function(e) {
      const input = e.target.value;
      if (/[0-9]/.test(input)) {
          e.target.value = input.replace(/[0-9]/g, '');
          document.getElementById('errorDescripcion').innerText = "No se permiten números en este campo";
      } else {
          document.getElementById('errorDescripcion').innerText = "";
      }
  });

  // Validación de precio mientras se escribe
  document.getElementById("precio").addEventListener("keypress", function(event) {
      const input = event.target.value;
      const dotCount = (input.match(/\./g) || []).length;

      if (!/[0-9.]/.test(event.key) || (event.key === '.' && dotCount >= 1)) {
          event.preventDefault();
      }
  });
});