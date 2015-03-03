<?php
include_once 'lib.php';
View::start('Registro');

intentosPrevios();

echo '<p>¡Regístrate en un minuto rellenando el siguiente formulario!</p>';
echo
'<form action = "comprobar_campos.php" method = "post">
    <p>Username: <input type = "text" name = "usuario" /></p>
    <p>Password: <input type = "password" name = "clave" /></p>
    <p>Nombre: <input type = "text" name = "nombre" /></p>
    <p>Email: <input type = "text" name = "email" /></p>
    <p><input type = "submit" value = "Entrar" /></p>
</form>';

View::end();

function intentosPrevios() {
    switch (filter_input(INPUT_GET, 'registro')) {
        case 1:
            echo '<p>Asegúrese de haber rellenado todos los campos...</p>';
            break;
        case 2: 
            echo '<p>La clave debe tener una longitud mínima de 8 caracteres...</p>';
            break;
        case 3:
            echo '<p>El username ya está usado...</p>';
            break;
        default:
            break;
    }
}