<?php

allFields();
usernameAvailable();
register();

function allFields() {
    if (!filter_input(INPUT_POST, 'new_username') || !filter_input(INPUT_POST, 'new_pass') || !filter_input(INPUT_POST, 'new_name') || !filter_input(INPUT_POST, 'new_email')) {
        header('Location: sign_up.php?register=1');
        exit(1);
    } elseif (strlen(filter_input(INPUT_POST, 'new_pass')) < 8) {
        header('Location: sign_up.php?register=2');
        exit(2);
    }

    if (filter_input(INPUT_POST, 'new_pass') !== filter_input(INPUT_POST, 'again_new_pass')) {
        header('Location: sign_up.php?register=4');
        exit(2);
    }
}

function usernameAvailable() {
    $result = (new PDO("sqlite:./datos.db"))->query('SELECT USUARIO FROM USUARIOS WHERE USUARIO ="' . filter_input(INPUT_POST, 'new_username') . '"');
    if ($result) {
        foreach ($result as $value) {
            if ($value['usuario'] == filter_input(INPUT_POST, 'new_username')) {
                header('Location: sign_up.php?register=3');
                exit(3);
            }
        }
    }
}

function register() {
    $inst = (new PDO('sqlite:./datos.db'))->prepare('INSERT INTO usuarios (usuario, clave, nombre, email, tipo) VALUES (?, ?, ?,?,?)');
    $res = $inst->execute([filter_input(INPUT_POST, 'new_username'), md5(filter_input(INPUT_POST, 'new_pass')), filter_input(INPUT_POST, 'new_name'), filter_input(INPUT_POST, 'new_email'), 0]);
    logIn();
    header('Location: home.php');
    exit(0);
}

function logIn() {
    session_start();
    $_SESSION["identify"] = TRUE;
    $_SESSION["type"] = 0;
    $_SESSION["username"] = filter_input(INPUT_POST, 'new_username');
    setcookie('name', (new PDO('sqlite:./datos.db'))->query('SELECT NOMBRE FROM USUARIOS WHERE USUARIO ="' . $_SESSION["username"] . '"')->fetchColumn(0));
    setcookie('userid', (new PDO('sqlite:./datos.db'))->query('SELECT id FROM USUARIOS WHERE USUARIO ="' . $_SESSION["username"] . '"')->fetchColumn(0));
    session_write_close();
}
