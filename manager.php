<?php

include_once './lib.php';
include_once './MyForm.php';


View::start('Administración');
session_start();
if (isset($_SESSION['identify']) and $_SESSION["type"] == 1) {
    previous();
    echo '<p id="message"></p>';
    echo MyForm::eraseUserForm();
    echo MyForm::deleteGameForm();
    echo MyForm::addModifyGameForm();
} else {
    header('Location:index.php');
}
session_write_close();
View::end();

function previous() {
    if (filter_input(INPUT_GET, 'code')) {
        switch (filter_input(INPUT_GET, 'code')) {
            case '-1':
                echo '<p>El usuario escrito no existe, por favor asegúrese de que el nombre es correcto...</p>';
                break;
            case '1':
                echo '<p>Escriba el nombre del usuario...</p>';
                break;
            case '2':
                echo '<p>El usuario se eliminó correctamente...</p>';
                break;
            case '3':
                echo '<p>Seleccione el juego a eliminar...</p>';
                break;
            case '4':
                echo '<p>El juego se eliminó correctamente...</p>';
                break;
            case '5':
                echo '<p>Introduzca el nombre del juego...</p>';
                break;
            case '6':
                echo '<p>Los juegos se actualizaron exitosamente...</p>';
                break;
            default:
                break;
        }
    }
}
