// Registro de los eventos que se desean controlar.
$(document).ready(function () {
    $('input[name="busqueda"]').val('Juego a buscar');

    /*
     * Comporbación formulario de búsqueda de un juego.
     */
    $('input[name="busqueda"]').on('click', searchForm);
    $('form[action="search.php"]').on('submit', function () {
        return searchForm();
    });

    // Comprobación de formulario de registro de un nuevo usuario.
    $('input[name="new_name"]').on('keyup', function () {
        required('input[name="new_name"]', 'input[name="new_name"] + span');
    });

    $('input[name="new_pass"]').on("keyup", function () {
        checkPassLength('input[name="new_pass"]', 'input[name="new_pass"] + span');
    });

    $('input[name="again_new_pass"]').on("keyup", function () {
        checkPasswords('input[name="new_pass"]', 'input[name="again_new_pass"]', 'input[name="again_new_pass"] + span');
    });

    $('input[name="new_username"]').on("keyup", function () {
        usernameAvailable('input[name="new_username"]', 'input[name="new_username"] + span');
    });

    $('input[name="new_email"]').on("keyup", function () {
        checkEmail('input[name="new_email"]', 'input[name="new_email"] + span');
    });

    $('input[name="new_email"]').on("mouseleave", function () {
        checkEmail('input[name="new_email"]', 'input[name="new_email"] + span');
    });

    $('form[action="register.php"]').on('submit', function () {
        return (required('input[name="new_name"]', 'input[name="new_name"] + span')
                && checkPassLength('input[name="new_pass"]', 'input[name="new_pass"] + span')
                && checkPasswords('input[name="new_pass"]', 'input[name="again_new_pass"]', 'input[name="again_new_pass"] + span')
                && usernameAvailable('input[name="new_username"]', 'input[name="new_username"] + span')
                && checkEmail('input[name="new_email"]', 'input[name="new_email"] + span'));
    });


    /*
     * Comprobación formulario de editar información personal
     */

    $('form[action="edit.php"]').on('submit', function () {
        if ($('input[name="edit_email"]').val() !== '' || $('input[name="edit_name"]').val() !== '') {
            return true;
        } else {
            $('#info').html('Rellene uno de los dos campos');
            return false;
        }
    });

    /*
     * Comporbación modificación de contraseña.
     */
    $('input[name="again_new_password"]').on('keyup', function () {
        checkPasswords('input[name="new_password"]', 'input[name="again_new_password"]', 'input[name="again_new_password"] + span');
    });
    
    $('input[name="new_password"]').on('keyup', function() {
        checkPassLength('input[name="new_password"]', 'input[name="new_password"] + span');
    });
    
    $('form[action="edit_password.php"]').on('submit', function () {
        return checkPasswords('input[name="new_password"]', 'input[name="again_new_password"]', 'input[name="again_new_password"] + span') && checkPassLength('input[name="new_password"]', 'input[name="new_password"] + span');
    });
    
    
});


// Comprueba que se haya introducido un texto para proceder a la búsqueda de un juego.
function searchForm() {
    if ($('input[name="busqueda"]').val() === '' || $('input[name="busqueda"]').val() === 'Juego a buscar') {
        $('input[name="busqueda"]').val('');
        $('input[name="busqueda"] + span').html('Introduzca el nombre del juego');
        return false;
    }
    return true;
}


// Comprueba que un campo haya sido rellenado e informa en caso contrario.
function required(element, infoElement) {
    if ($(element).val() === '') {
        $(infoElement).html('Este campo es obligatorio');
        return false;
    } else {
        $(infoElement).html('');
        return true;
    }
}

// Comprueba que las contraeñas tengan una longitud mínima.
function checkPassLength(element, infoelement) {
    if ($(element).val().length < 8) {
        $(infoelement).html(' La contraseña debe tener una longitud mínima de 8 caracteres');
        return false;
    } else {
        $(infoelement).html('');
        return true;
    }
}

// Comprueba mediante petición ajax que un usuario exista.
function usernameAvailable(element, infoElement) {
    if ($(element).val() === '') {
        $(infoElement).html('Introduzca un username');
        return;
    }
    username = $(element).val();
    $.ajax({
        url: "username_available.json.php",
        type: "POST",
        data: JSON.stringify({"username": username}),
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        success: function (res) {
            if (res.exists) {
                $(infoElement).html('Existe un usuario con ese nombre');
            } else {
                $(infoElement).html('');
            }
        },
        error: function (res) {
            info(res);
        }
    });
}

// Comprueba que las contraseñas a la hora del registro o cambio coincidan.
function checkPasswords(firstPass, secondPass, infoElement) {
    if ($(firstPass).val() !== $(secondPass).val()) {
        $($(infoElement).html('Las contraseñas no coindicen'));
        return false;
    } else {
        $($(infoElement).html(''));
        return true;
    }
}

// Informa de error en caso de fallo en la petición AJAX.
function info(info) {
    $('input[name="new_username"] + span').html(info);
}


// Comprueba que la dirección de correo cumpla el formato adecuado.
function checkEmail(emailInput, infoElement) {
    var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    if (!regex.test($(emailInput).val().trim())) {
        $(infoElement).html('Dirección de coreo no valida');
        return false;
    } else {
        $(infoElement).html('');
    }
}

// REaliza una petición ajax para borrar un ususario.
function deleteUser() {
    function deleteAjax() {
        $.ajax({
            url: "delete_user.json.php",
            type: "POST",
            data: JSON.stringify({"username": $('input[name="delete_user"]').val()}),
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            success: function (res) {
                if (res.exists) {
                    $('#message').html(res.message);
                } else {
                    errors(res.message);
                }
            },
            error: function (res) {
                errors(res.message);
            }
        });
    }
    confirmDelete($('input[name="delete_user"]').val(), deleteAjax);
}
function errors(texto) {
    $dialogo = $('<div></div>');
    $dialogo.text(texto);
    $dialogo.dialog({
        title: 'error',
        width: 200,
        modal: true
    });
}

function confirmDelete(name, action) {
    dialogo = $('<div></div>');
    dialogo.text("¿Desea eliminar al usuario'" + name + "'?");
    dialogo.dialog({
        title: 'Borrar usuario',
        width: 200,
        modal: true,
        buttons: {
            'Sí': function () {
                $(this).dialog('close');
                action();
            },
            'No': function () {
                $(this).dialog('close');
            }
        }
    });
}