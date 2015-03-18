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



function notify() {
    var span = $('input[name="new_pass"] + span');
    if ($('input[name="new_pass"]').val().length < 8) {
        span.html('');
        span.append(' La contraseña debe tener una longitud mínima de 8 caracteres');
    } else {
        $('input[name="new_pass"] + span').html('');
    }
}
$(document).ready(function () {
    $("input").on("click", notify);
});