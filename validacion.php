<?php

comprobarFormulario();

function comprobarFormulario() {
    if (filter_input(INPUT_POST, 'username') == '' || filter_input(INPUT_POST, 'password')== '') {
        header("Location: login.php?error=1");
        exit(1);
    } else {
        $id = validarUsuario();
        if ($id < 0) {
            header("Location: login.php?error=2");
            exit(2);
        } else {
            iniciarSesion($id);
            header("Location: principal.php");
            exit(0);
        }
    }
}

function validarUsuario() {
    $row = (new SQLite3('datos.db'))->query('SELECT USUARIO,CLAVE,TIPO FROM USUARIOS WHERE USUARIO ="' . filter_input(INPUT_POST, 'username') . '"')->fetchArray();
    if ($row[0] != filter_input(INPUT_POST, 'username') || $row[1] != md5(filter_input(INPUT_POST, 'password'))) {
        return -1;
    }
    return $row[2];
}

function iniciarSesion($id) {
    session_start();
    $_SESSION["identificado"] = TRUE;
    $_SESSION["usuario"] = filter_input(INPUT_POST, 'username');
    $_SESSION["id"] = $id;
    setcookie('nombre', (new SQLite3('datos.db'))->query('SELECT NOMBRE FROM USUARIOS WHERE USUARIO ="' . $_SESSION["usuario"] . '"')->fetchArray()[0]);
    setcookie('idusuario', (new SQLite3('datos.db'))->query('SELECT ID FROM USUARIOS WHERE USUARIO ="' . $_SESSION["usuario"] . '"')->fetchArray()[0]);
}
