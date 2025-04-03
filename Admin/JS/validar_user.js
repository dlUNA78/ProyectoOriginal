document.addEventListener('DOMContentLoaded', function() {
    // Toggle para mostrar contraseñas
    const showPasswords = document.getElementById('showPasswords');
    const passwordField = document.getElementById('contraseña');
    const confirmPasswordField = document.getElementById('contraseñaConf');
    
    if (showPasswords) {
        showPasswords.addEventListener('change', function() {
            const type = this.checked ? 'text' : 'password';
            passwordField.type = type;
            confirmPasswordField.type = type;
        });
    }

    // Validación del formulario
    const form = document.getElementById('formulario');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateForm()) {
                this.submit();

            }
        });
    }

    // Validación en tiempo real
    document.getElementById('nombre')?.addEventListener('input', validateNombre);
    document.getElementById('usuario')?.addEventListener('input', validateEmail);
    document.getElementById('contraseña')?.addEventListener('input', validatePassword);
    document.getElementById('contraseñaConf')?.addEventListener('input', validatePasswordMatch);

    // Funciones de validación
    function validateForm() {
        let isValid = true;
        
        if (!validateNombre()) isValid = false;
        if (!validateEmail()) isValid = false;
        if (!validatePassword()) isValid = false;
        if (!validatePasswordMatch()) isValid = false;
        if (!validateImage()) isValid = false;
        
        return isValid;

    }

    function validateNombre() {
        const value = document.getElementById('nombre').value.trim();
        const errorElement = document.getElementById('errorNombre');
        const nameRegex = /^[A-Za-zÁÉÍÓÚáéíóúÜüÑñ\s]+$/;
        
        if (!value) {
            showError(errorElement, 'El nombre es obligatorio');
            return false;
        }
        
        if (!nameRegex.test(value)) {
            showError(errorElement, 'Solo letras y espacios (sin números ni símbolos)');
            return false;
        }
        
        clearError(errorElement);
        return true;
    }

    function validateEmail() {
        const value = document.getElementById('usuario').value.trim();
        const errorElement = document.getElementById('errorUsuario');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!value) {
            showError(errorElement, 'El email es obligatorio');
            return false;
        }
        
        if (!emailRegex.test(value)) {
            showError(errorElement, 'Email no válido');
            return false;
        }
        
        clearError(errorElement);
        return true;
    }

    function validatePassword() {
        const value = document.getElementById('contraseña').value;
        const errorElement = document.getElementById('errorContraseña');
        
        if (!value) {
            showError(errorElement, 'La contraseña es obligatoria');
            return false;
        }
        
        if (value.length < 8) {
            showError(errorElement, 'Mínimo 8 caracteres');
            return false;
        }
        
        if (!/[A-Z]/.test(value)) {
            showError(errorElement, 'Al menos una mayúscula');
            return false;
        }
        
        if (!/[0-9]/.test(value)) {
            showError(errorElement, 'Al menos un número');
            return false;
        }
        
        if (!/[!@#$%^&*(),.?":{}|<>]/.test(value)) {
            showError(errorElement, 'Al menos un símbolo');
            return false;
        }
        
        clearError(errorElement);
        return true;
    }

    function validatePasswordMatch() {
        const password = document.getElementById('contraseña').value;
        const confirmPassword = document.getElementById('contraseñaConf').value;
        const errorElement = document.getElementById('errorContraseñaConf');
        
        if (!confirmPassword) {
            showError(errorElement, 'Confirme su contraseña');
            return false;
        }
        
        if (password !== confirmPassword) {
            showError(errorElement, 'Las contraseñas no coinciden');
            return false;
        }
        
        clearError(errorElement);
        return true;
    }

    function validateImage() {
        const fileInput = document.getElementById('imagen');
        const errorElement = document.getElementById('errorImagen');
        
        if (!fileInput.files || fileInput.files.length === 0) {
            showError(errorElement, 'La imagen es obligatoria');
            return false;
        }
        
        const file = fileInput.files[0];
        const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
        const maxSize = 2 * 1024 * 1024;
        
        if (!validTypes.includes(file.type)) {
            showError(errorElement, 'Formato no válido (JPG, PNG, WEBP)');
            return false;
        }
        
        if (file.size > maxSize) {
            showError(errorElement, 'La imagen no debe superar 2MB');
            return false;
        }
        
        clearError(errorElement);
        return true;
    }

    function showError(element, message) {
        if (element) {
            element.textContent = message;
            element.style.display = 'block';
        }
    }

    function clearError(element) {
        if (element) {
            element.textContent = '';
            element.style.display = 'none';
        }
    }
    // Redirigir a la página de usuario después de la modificación

});