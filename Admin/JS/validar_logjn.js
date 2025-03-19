
const contraseñasUsuarios = {
    "Yesid@gmail.com": "Yessid1!",
    "Efrain@gmail.com": "Efrain1!",
    "Trino@gmail.com": "Trino12!",
    "Guero@gmail.com": "Guero12!"
};

// Función para validar el usuario
function validarUsuario() {
    const usuario = document.getElementById("usuario").value.trim();
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (usuario === "") {
        mostrarError("errorUsuario", "Ingrese un usuario");
        return false;
    } else if (!regex.test(usuario)) {
        mostrarError("errorUsuario", "Ingrese un correo válido");
        return false;
    } else {
        ocultarError("errorUsuario");
        return true;
    }
}

// Función para validar la contraseña ingresada
function validarContraseña() {
    const usuario = document.getElementById("usuario").value.trim();
    const contraseñaIngresada = document.getElementById("contraseña").value;

    // Verificar si el usuario existe en la lista
    if (!(usuario in contraseñasUsuarios)) {
        mostrarError("errorUsuario", "El usuario no está registrado");
        return false;
    }

    // Validar la contraseña asociada al usuario
    if (contraseñaIngresada !== contraseñasUsuarios[usuario]) {
        mostrarError("errorContraseña", "Usuario o contraseña incorrectos");
        return false;
    }

    ocultarError("errorContraseña");
    return true;
}

// Funciones para mostrar y ocultar errores
function mostrarError(idError, mensaje) {
    document.getElementById(idError).textContent = mensaje;
}

function ocultarError(idError) {
    document.getElementById(idError).textContent = "";
}

// Función para validar el formulario y redirigir si es correcto
function validarFormulario() {
    const usuarioValido = validarUsuario();
    const contraseñaValida = validarContraseña();

    if (usuarioValido && contraseñaValida) {
        window.location.href = "../../Admin/Menú/index.html";

        // Limpiar los campos después de un login exitoso
        document.getElementById("usuario").value = "";
        document.getElementById("contraseña").value = "";
    }
}

// Event listener para el formulario
document.getElementById("FormularioLogin").addEventListener("submit", function (event) {
    event.preventDefault();
    validarFormulario();
});


// Función para mostrar/ocultar contraseña
function togglePasswords() {
    const passwordField = document.getElementById('contraseña');
    const showPasswordsCheckbox = document.getElementById('showPasswords');

    if (showPasswordsCheckbox.checked) {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
}