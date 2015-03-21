/*
 /*$(document).ready(function () {
 $('form[action="search.php"]').submit(function () {
 if ($('input[name="busqueda"]').val() === '' || $('input[name="busqueda"]').val() === 'Juego a buscar...') {
 $('.error').html(' <br>Introduzca un nombre...');
 return false;
 } else {
 return true;
 }
 });
 });
 
 $(document).ready(function () {
 $('input[name="busqueda"]').val('Juego a buscar...');
 $('input[name="busqueda"]').click(function () {
 if ($('input[name="busqueda"]').val() === 'Juego a buscar...') {
 $('input[name="busqueda"]').val('');
 }
 }).blur(function () {
 if ($('input[name="busqueda"]').val() === '') {
 $('input[name="busqueda"]').val('Juego a buscar...');
 }
 });
 });
 
 $(document).ready(function () {
 $('form[action="sign_in.php"]').submit(function () {
 if ($('input[name="username"]').val() === '') {
 $('input[name="username"] + span').html('<br>Introduzca su username');
 return false;
 }
 if ($('input[name="password"]').val() === '') {
 $('input[name="password"]').append('<br>Ha olvidado indicar su contraseña');
 return false;
 }
 return true;
 });
 });
 
 
 $(document).ready(function () {
 var span = $('input[name="new_pass"] + span');
 $('input[name="new_pass"]').click(function () {
 if ($('input[name="new_pass"]').val().length < 8) {
 span.html('');
 span.append(' La contraseña debe tener una longitud mínima de 8 caracteres');
 } else {
 $('input[name="new_pass"] + span').html('');
 }
 });
 });
 
 
 
 $(document).ready(function() {
 $('input[name="new_pass"]').click(passwordEvent());
 });
 
 function passwordEvent() {
 var span = $('input[name="new_pass"] + span');
 if ($('input[name="new_pass"]').val().length < 8) {
 span.html('');
 span.append(' La contraseña debe tener una longitud mínima de 8 caracteres');
 } else {
 $('input[name="new_pass"] + span').html('');
 }
 }*/


function checkPassLength() {
    var span = $('input[name="new_pass"] + span');
    if ($('input[name="new_pass"]').val().length < 8) {
        span.html(' La contraseña debe tener una longitud mínima de 8 caracteres');
    } else {
        $('input[name="new_pass"] + span').html('');
    }
}

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
                $(infoElement).html('El username está ocupado');
            } else {
                error(res.message);
            }
        },
        error: function (res) {
            error(res);
        }
    });
}


function checkPasswords(firstPass,secondPass,infoElement) {
    if($(firstPass).val() !== $(secondPass).val()) {
        $($(infoElement).html('Las contraseñas no coindicen'));
    }
}

function error(info) {
    $('input[name="new_username"] + span').html(info);
}
$(document).ready(function () {
    $('input[name="new_pass"]').on("keyup", checkPassLength);
    $('input[name="again_new_pass"]').on("keyup", function () {
        checkPasswords('input[name="new_pass"]','input[name="again_new_pass"]','input[name="again_new_pass"] + span');
    });
    $('input[name="new_username"]').on("keyup", function () {
        usernameAvailable('input[name="new_username"]', 'input[name="new_username"] + span');
    });
});



/*
 * function usernameAvailable() {
 $('input[name="new_username"] span').html('hola4');
 $.ajax({
 url: "username_available.json.php",
 type: "POST",
 data: JSON.stringify({"new_username": 'pepe'}),
 contentType: "application/json;charset=utf-8",
 dataType: "json",
 success: function (res) {
 if (res.exists) {
 $('input[name="new_username"] span').html('hola');
 } else {
 $('input[name="new_username"] span').html('hola2');
 error(res.message);
 }
 },
 error: function (res) {
 $('input[name="new_username"] span').html('hola3');
 error(res);
 }
 });
 }
 
 function error() {
 $('input[name="new_username"] span').html('hola4');
 }
 * */