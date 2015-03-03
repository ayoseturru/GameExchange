<?php

include_once 'lib.php';
View::start('Modificar Contraseña');
session_start();

if (!$_SESSION['identificado']) {
    session_write_close();
    header('Location:login.php');
    exit(1);
} else {
    intentosPrevios();
    mostrarPasswordField();
}

session_write_close();
View::end();

function mostrarPasswordField() {
    echo
    '<form action = "editar_password.php" method = "post">
    <p>Antigua Contraseña: <input type = "password" name = "antigua_password" /></p>
    <p>Nueva Contraseña: <input type = "password" name = "nueva_password" /></p>
    <p><input type = "submit" value="Modificar" /></p>
    </form>';
}

function intentosPrevios() {
    switch (filter_input(INPUT_GET, 'passwd')) {
        case 1:
            echo '<p>Asegúrese de haber rellenado ambos cambos...</p>';
            break;
        case 2:
            echo '<p>La contraseña debe tener una longitud mínima de 8 caracteres...</p>';
            break;
        case 3:
            echo '<p>La contraseña actual no es correcta...</p>';
            break;
        case 4:
            echo '<p>La contraseña se ha cambiado correctamente</p>';
            break;
        default:
            break;
    }
}
