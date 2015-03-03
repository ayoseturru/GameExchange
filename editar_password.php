<?php

if (!filter_input(INPUT_POST, 'antigua_password') || !filter_input(INPUT_POST, 'nueva_password')) {
    header('Location: password.php?passwd=1');
    exit(1);
}

if (strlen(filter_input(INPUT_POST, 'nueva_password')) < 8) {
    header('Location: password.php?passwd=2');
    exit(2);
}

session_start();
if (md5(filter_input(INPUT_POST, 'antigua_password')) != (new SQLite3('datos.db'))->query('SELECT CLAVE FROM USUARIOS WHERE usuario="'
                . $_SESSION['usuario'] . '"')->fetchArray()[0]) {
    session_write_close();
    header('Location: password.php?passwd=3');
    exit(3);
}

(new SQLite3('datos.db'))->exec('UPDATE USUARIOS SET clave="' . md5(filter_input(INPUT_POST, 'nueva_password')) . '" WHERE usuario="'
        . $_SESSION["usuario"] . '"');
session_write_close();
header('Location: password.php?passwd=4');
exit(1);
