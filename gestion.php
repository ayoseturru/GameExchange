<?php

include_once './lib.php';
include_once './formulario.php';


View::start('Administración');
session_start();
if (in_array('identificado', $_SESSION) and $_SESSION["id"] == 1) {
    intentosPrevios();
    echo Formulario::formularioBorrarUusuario();
    echo Formulario::formularioAñadirJuego();
    echo Formulario::formularioAñadirModificarJuego();
} else {
    header('Location:index.php');
}
session_write_close();
View::end();

function intentosPrevios() {
    if (filter_input(INPUT_GET, 'codigo')) {
        switch (filter_input(INPUT_GET, 'codigo')) {
            case '-1':
                echo '<p>El usuario escrito no existe, por favor asegúrese de que el nombre es correcto...</p>';
                break;
            case '1':
                echo '<p>Escriba el nombre del uusuario...</p>';
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
