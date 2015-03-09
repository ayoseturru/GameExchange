<?php

include_once 'lib.php';
include_once './MyForm.php';
View::start('Modificar Contraseña');
session_start();

if (!$_SESSION['identify']) {
    session_write_close();
    header('Location:login.php');
    exit(1);
} else {
    previous();
    mostrarPasswordField();
}

session_write_close();
View::end();

function mostrarPasswordField() {
    echo MyForm::editPasswordForm();
}

function previous() {
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
        case 5:
            echo '<p>Las contraseñas no coinciden...</p>';
            break;
        default:
            break;
    }
}
