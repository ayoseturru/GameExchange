<?php

session_start();

if (filter_input(INPUT_POST, 'edit_name')) {
    $inst = (new PDO('sqlite:./datos.db'))->prepare('UPDATE USUARIOS SET NOMBRE=? WHERE USUARIO=?');
    $res = $inst->execute(array(filter_input(INPUT_POST, 'edit_name'), $_SESSION["username"]));
    setcookie('name',filter_input(INPUT_POST, 'edit_name'));
}

if (filter_input(INPUT_POST, 'edit_email')) {
    $inst = (new PDO('sqlite:./datos.db'))->prepare('UPDATE USUARIOS SET email=? WHERE USUARIO=?');
    $res = $inst->execute(array(filter_input(INPUT_POST, 'edit_email'), $_SESSION["username"]));
}

session_write_close();
header('Location:edit_profile.php?changes=1');
exit(0);