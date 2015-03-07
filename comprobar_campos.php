<?php

allFields();
usernameAvailable();
register();

function allFields() {
    if (!filter_input(INPUT_POST, 'usuario') || !filter_input(INPUT_POST, 'clave') || !filter_input(INPUT_POST, 'nombre') || !filter_input(INPUT_POST, 'email')) {
        header('Location: registro.php?registro=1');
        exit(1);
    } elseif (strlen(filter_input(INPUT_POST, 'clave')) < 8) {
        header('Location: registro.php?registro=2');
        exit(2);
    }
}

function usernameAvailable() {
    $result = (new PDO("sqlite:./datos.db"))->query('SELECT USUARIO FROM USUARIOS WHERE USUARIO ="' . filter_input(INPUT_POST, 'usuario') . '"');
    if ($result) {
        foreach ($result as $value) {
            if ($value[usuario] == filter_input(INPUT_POST, 'usuario')) {
                header('Location: registro.php?registro=3');
                exit(3);
            }
        }
    }
}

function register() {
    $inst = (new PDO('sqlite:./datos.db'))->prepare('INSERT INTO usuarios (usuario, clave, nombre, email, tipo) VALUES (?, ?, ?,?,?)');
    $res = $inst->execute([filter_input(INPUT_POST, 'usuario'), md5(filter_input(INPUT_POST, 'clave')), filter_input(INPUT_POST, 'nombre'), filter_input(INPUT_POST, 'email'), 0]);
    logIn();
    header('Location: principal.php');
    exit(0);
}

function logIn() {
    session_start();
    $_SESSION["identificado"] = TRUE;
    $_SESSION["id"] = 0;
    $_SESSION["usuario"] = filter_input(INPUT_POST, 'usuario');
    setcookie('nombre',(new PDO('sqlite:./datos.db'))->query('SELECT NOMBRE FROM USUARIOS WHERE USUARIO ="' . $_SESSION["usuario"] . '"')->fetchColumn(0));
    setcookie('idusuario',(new PDO('sqlite:./datos.db'))->query('SELECT id FROM USUARIOS WHERE USUARIO ="' . $_SESSION["usuario"] . '"')->fetchColumn(0));
    session_write_close();
}
