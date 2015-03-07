<?php

comprobarFormulario();

function comprobarFormulario() {
    if (filter_input(INPUT_POST, 'username') == '' || filter_input(INPUT_POST, 'password') == '') {
        header("Location: login.php?error=1");
        exit(1);
    } else {
        $id = validarUsuario();
        if ($id < 0) {
            header("Location: login.php?error=2");
            exit(2);
        } else {
            logIn($id);
            header("Location: principal.php");
            exit(0);
        }
    }
}

function validarUsuario() {
    $userinfo = (new PDO('sqlite:./datos.db'))->query('SELECT USUARIO,CLAVE,TIPO FROM USUARIOS WHERE USUARIO ="' . filter_input(INPUT_POST, 'username') . '"');
    if ($userinfo) {
        foreach ($userinfo as $valor) {
            if ($valor['usuario'] != filter_input(INPUT_POST, 'username') || $valor['clave'] != md5(filter_input(INPUT_POST, 'password'))) {
                return -1;
            }
            return $valor['tipo'];
        }
    }
    return -1;
}

function logIn($id) {
    session_start();
    $_SESSION["identificado"] = TRUE;
    $_SESSION["id"] = $id;
    $_SESSION["usuario"] = filter_input(INPUT_POST, 'username');
    setcookie('nombre', (new PDO('sqlite:./datos.db'))->query('SELECT NOMBRE FROM USUARIOS WHERE USUARIO ="' . $_SESSION["usuario"] . '"')->fetchColumn(0));
    setcookie('idusuario', (new PDO('sqlite:./datos.db'))->query('SELECT id FROM USUARIOS WHERE USUARIO ="' . $_SESSION["usuario"] . '"')->fetchColumn(0));
    session_write_close();
}
