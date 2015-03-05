<?php

camposRellenos();
usernameDisponible();
registro();

function camposRellenos() {
    if (!filter_input(INPUT_POST, 'usuario') || !filter_input(INPUT_POST, 'clave') || !filter_input(INPUT_POST, 'nombre') || !filter_input(INPUT_POST, 'email')) {
        header('Location: registro.php?registro=1');
        exit(1);
    } elseif (strlen(filter_input(INPUT_POST, 'clave')) < 8) {
        header('Location: registro.php?registro=2');
        exit(2);
    }
}

function usernameDisponible() {
    $row = (new SQLite3('datos.db'))->query('SELECT USUARIO FROM USUARIOS WHERE USUARIO ="' . filter_input(INPUT_POST, 'usuario') . '"')->fetchArray();
    if ($row) {
        header('Location: registro.php?registro=3');
        exit(3);
    }
}

function registro() {
    (new SQLite3('datos.db'))->exec('INSERT INTO USUARIOS (USUARIO, CLAVE, NOMBRE, EMAIL, TIPO) VALUES ("'
            . filter_input(INPUT_POST, 'usuario') . '","' . md5(filter_input(INPUT_POST, 'clave')) . '","' .
            filter_input(INPUT_POST, 'nombre') . '","' . filter_input(INPUT_POST, 'email') . '",0)');
    iniciarSesion();
    header('Location: principal.php');
    exit(0);
}

function iniciarSesion() {
    session_start();
    $_SESSION["identificado"] = TRUE;
    $_SESSION["id"] = 0;
    $_SESSION["usuario"] = filter_input(INPUT_POST, 'usuario');
    setcookie('nombre', (new SQLite3('datos.db'))->query('SELECT NOMBRE FROM USUARIOS WHERE USUARIO ="' . $_SESSION["usuario"] . '"')->fetchArray()[0]);
    setcookie('idusuario', (new SQLite3('datos.db'))->query('SELECT ID FROM USUARIOS WHERE USUARIO ="' . $_SESSION["usuario"] . '"')->fetchArray()[0]);
    session_write_close();
}
