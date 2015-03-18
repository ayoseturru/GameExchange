$(document).ready(function () {
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

