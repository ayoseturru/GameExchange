<?php

if (!filter_input(INPUT_POST, 'old_password') || !filter_input(INPUT_POST, 'new_password') || !filter_input(INPUT_POST, 'again_new_password')) {
    header('Location: password.php?passwd=1');
    exit(1);
}

if (strlen(filter_input(INPUT_POST, 'new_password')) < 8 || strlen(filter_input(INPUT_POST, 'again_new_password')) < 8) {
    header('Location: password.php?passwd=2');
    exit(2);
}

if (filter_input(INPUT_POST, 'new_password') !== filter_input(INPUT_POST, 'again_new_password')) {
    header('Location: password.php?passwd=5');
    exit(2);
}

session_start();
if (md5(filter_input(INPUT_POST, 'old_password')) != (new PDO('sqlite:./datos.db'))->query('SELECT CLAVE FROM USUARIOS WHERE usuario="'
                . $_SESSION['username'] . '"')->fetchColumn(0)) {
    session_write_close();
    header('Location: password.php?passwd=3');
    exit(3);
}

$inst = (new PDO('sqlite:./datos.db'))->prepare('UPDATE USUARIOS SET clave=? WHERE USUARIO=?');
$res = $inst->execute(array(md5(filter_input(INPUT_POST, 'new_password')), $_SESSION["username"]));
session_write_close();
header('Location: password.php?passwd=4');
exit(1);
