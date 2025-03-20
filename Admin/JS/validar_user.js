
function togglePasswords() {
    // Obtener los campos de contraseña
    const passwordField = document.getElementById('contraseña');
    const confirmPasswordField = document.getElementById('contraseñaConf');

    // Obtener el checkbox
    const showPasswordsCheckbox = document.getElementById('showPasswords');

    // Cambiar el tipo de input de los campos de contraseña
    if (showPasswordsCheckbox.checked) {
        passwordField.type = 'text';
        confirmPasswordField.type = 'text';
    } else {
        passwordField.type = 'password';
        confirmPasswordField.type = 'password';
    }
}

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


document.getElementById('agregar').addEventListener('click', function (event) {
    event.preventDefault();

    const nombre = document.getElementById('nombre').value;
    const usuario = document.getElementById('usuario').value;
    const contraseña = document.getElementById('contraseña').value;
    const contraseñaConf = document.getElementById('contraseñaConf').value;

    document.getElementById('errorNombre').innerText = "";
    document.getElementById('errorUsuario').innerText = "";
    document.getElementById('errorContraseña').innerText = "";

    document.getElementById('showPasswords').addEventListener('change', togglePasswords);

    let isValid = true;
    if (contraseña !== contraseñaConf) {
        document.getElementById('errorContraseñaConf').innerText = "Las contraseñas no coinciden";
        isValid = false;
    }
    if (nombre === "") {
        document.getElementById('errorNombre').innerText = "Ingrese un nombre";
        isValid = false;
    }
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+(?:\.(?!com\.)[a-zA-Z]{2,}|\.com(?!.*\.com))$/;
    if (usuario === "") {
        document.getElementById('errorUsuario').innerText = "Ingrese un correo";
        isValid = false;
    } else if (!regex.test(usuario)) {
        document.getElementById('errorUsuario').innerText = "Debe ingresar un correo electronico válido";
        isValid = false;
    }
    if (!ValidarContraseña(contraseña)) {
        isValid = false;
    }
    if (contraseñaConf === "") {
        document.getElementById('errorContraseñaConf').innerText = "Confirme la contraseña";
        isValid = false;

    }

    if (isValid) {
        const modal = new bootstrap.Modal(document.getElementById('Agregado'));
        modal.show();
        document.getElementById('nombre').value = "";
        document.getElementById('usuario').value = "";
        document.getElementById('contraseña').value = "";
        document.getElementById('contraseñaConf').value = "";
    }


});




document.getElementById("nombre").addEventListener("keypress", function (event) {
    if (!/[a-zA-Z]/.test(event.key)) {
        event.preventDefault();
    }
});
