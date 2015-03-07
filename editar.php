<?php

session_start();

if (filter_input(INPUT_POST, 'editar_nombre')) {
    $inst = (new PDO('sqlite:./datos.db'))->prepare('UPDATE USUARIOS SET NOMBRE=? WHERE USUARIO=?');
    $res = $inst->execute(array(filter_input(INPUT_POST, 'editar_nombre'), $_SESSION["usuario"]));
    $_COOKIE["nombre"] = filter_input(INPUT_POST, 'editar_nombre');
}

if (filter_input(INPUT_POST, 'editar_email')) {
    $inst = (new PDO('sqlite:./datos.db'))->prepare('UPDATE USUARIOS SET email=? WHERE USUARIO=?');
    $res = $inst->execute(array(filter_input(INPUT_POST, 'editar_email'), $_SESSION["usuario"]));
}

session_write_close();
header('Location:gestion_perfil.php?cambios=1');
exit(0);