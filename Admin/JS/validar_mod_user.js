function togglePasswords() {
    // Obtener los campos de contraseña
    const currentpasswordField = document.getElementById('contraseñaAct');
    const passwordField = document.getElementById('contraseña');
    const confirmPasswordField = document.getElementById('contraseñaConf');

    // Obtener el checkbox
    const showPasswordsCheckbox = document.getElementById('showPasswords');

    // Cambiar el tipo de input de los campos de contraseña
    const type = showPasswordsCheckbox.checked ? 'text' : 'password';
    currentpasswordField.type = type;
    passwordField.type = type;
    confirmPasswordField.type = type;
}

// Almacenar las contraseñas de los usuarios
const contraseñasUsuarios = {
    "Yesid@gmail.com": "Yessid1!",
    "Efrain@gmail.com": "Efrain1!",
    "Trino@gmail.com": "Trino12!",
    "Guero@gmail.com": "Guero12!"
};

function ValidarContraseña(contraseña) {
    let errorMensaje = "";

    const tieneNumero = /\d/.test(contraseña);
    const tieneMayuscula = /[A-Z]/.test(contraseña);
    const tieneSimbolo = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(contraseña);

    if (contraseña === "") {
        errorMensaje += "Ingresa una contraseña.\n";
    } else {
        if (contraseña.length < 8)
            errorMensaje += "Mínimo 8 caracteres.\n";
        if (!tieneNumero) errorMensaje += "Debe contener al menos un número.\n";
        if (!tieneMayuscula) errorMensaje += "Debe contener al menos una mayúscula.\n";
        if (!tieneSimbolo) errorMensaje += "Debe contener al menos un símbolo.\n";
    }

    document.getElementById('errorContraseña').innerText = errorMensaje;
    return errorMensaje === ""; // Devuelve true si la contraseña es válida
}

// Función para validar la contraseña anterior o actual
function validarContraseñaAnterior() {
    let usuario = document.getElementById('usuario').value; // Obtener el usuario seleccionado
    let contraseñaAct = document.getElementById('contraseñaAct').value; // Obtener la contraseña ingresada

    // Obtener la contraseña real del usuario desde el objeto
    let contraseñaReal = contraseñasUsuarios[usuario];

    if (contraseñaReal && contraseñaAct !== contraseñaReal) {
        document.getElementById('errorContraseñaAct').innerText = "La contraseña actual es incorrecta";
        return false;
    } else {
        document.getElementById('errorContraseñaAct').innerText = ""; // Limpiar mensaje de error si es correcta
        return true;
    }
}


document.getElementById('agregar').addEventListener('click', function (event) {
    event.preventDefault();

    const nombre = document.getElementById('nombre').value.trim();
    const usuario = document.getElementById('usuario').value.trim();
    const contraseñaAct = document.getElementById('contraseñaAct').value;
    const contraseña = document.getElementById('contraseña').value;
    const contraseñaConf = document.getElementById('contraseñaConf').value;

    document.getElementById('errorNombre').innerText = "";
    document.getElementById('errorUsuario').innerText = "";
    document.getElementById('errorContraseñaAct').innerText = "";
    document.getElementById('errorContraseña').innerText = "";
    document.getElementById('errorContraseñaConf').innerText = "";

    document.getElementById('showPasswords').addEventListener('change', togglePasswords);

    let isValid = true;

    if (nombre === "") {
        document.getElementById('errorNombre').innerText = "Por favor, completa este campo.";
        isValid = false;
    }

    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (usuario === "") {
        document.getElementById('errorUsuario').innerText = "Ingrese un correo";
        isValid = false;
    } else if (!regex.test(usuario)) {
        document.getElementById('errorUsuario').innerText = "Debe ingresar un correo electrónico válido";
        isValid = false;
    }

    if (!validarContraseñaAnterior(contraseñaAct)) {
        isValid = false;
    }

    if (!ValidarContraseña(contraseña)) {
        isValid = false;
    }

    if (contraseña !== contraseñaConf) {
        document.getElementById('errorContraseñaConf').innerText = "Las contraseñas no coinciden";
        isValid = false;
    } else if (contraseñaConf === "") {
        document.getElementById('errorContraseñaConf').innerText = "Confirme la contraseña";
        isValid = false;
    }

    if (isValid) {
        const modal = new bootstrap.Modal(document.getElementById('modal-1'));
        modal.show();

        // Limpiar los campos del formulario
        document.getElementById('nombre').value = "";
        document.getElementById('usuario').value = "";
        document.getElementById('contraseñaAct').value = "";
        document.getElementById('contraseña').value = "";
        document.getElementById('contraseñaConf').value = "";
    }
});

document.getElementById("nombre").addEventListener("keypress", function (event) {
    if (!/[a-zA-Z]/.test(event.key)) {
        event.preventDefault();
    }
});