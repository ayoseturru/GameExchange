<?php

checkForm();

function checkForm() {
    if (filter_input(INPUT_POST, 'username') == '' || filter_input(INPUT_POST, 'password') == '') {
        header("Location: login.php?error=1");
        exit(1);
    } else {
        $type = checkUser();
        if ($type < 0) {
            header("Location: login.php?error=2");
            exit(2);
        } else {
            logIn($type);
            header("Location: home.php");
            exit(0);
        }
    }
}

function checkUser() {
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

function logIn($type) {
    session_start();
    $_SESSION["identify"] = TRUE;
    $_SESSION["type"] = $type;
    $_SESSION["username"] = filter_input(INPUT_POST, 'username');
    setcookie('name', (new PDO('sqlite:./datos.db'))->query('SELECT NOMBRE FROM USUARIOS WHERE USUARIO ="' . $_SESSION["username"] . '"')->fetchColumn(0));
    setcookie('userid', (new PDO('sqlite:./datos.db'))->query('SELECT id FROM USUARIOS WHERE USUARIO ="' . $_SESSION["username"] . '"')->fetchColumn(0));
    session_write_close();
}
