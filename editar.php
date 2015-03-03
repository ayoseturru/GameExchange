<?php

session_start();

if (filter_input(INPUT_POST, 'editar_nombre')) {
    (new SQLite3('datos.db'))->exec('UPDATE USUARIOS SET nombre="' . filter_input(INPUT_POST, 'editar_nombre') . '" WHERE usuario="'
            . $_SESSION["usuario"] . '"');
}

if (filter_input(INPUT_POST, 'editar_email')) {
    (new SQLite3('datos.db'))->exec('UPDATE USUARIOS SET email="' . filter_input(INPUT_POST, 'editar_email') . '" WHERE usuario="'
            . $_SESSION["usuario"] . '"');
}

session_write_close();
header('Location:gestion_perfil.php?cambios=1');
exit(0);