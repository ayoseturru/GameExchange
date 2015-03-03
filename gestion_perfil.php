<?php

include_once './lib.php';
View::start('Gestionar mi perfil');
session_start();

if (usuarioLogueado()) {
    mostrarFormularios();
} else {
    session_write_close();
    header('Location:login.php');
    exit(1);
}

session_write_close();
View::end();
exit(0);

function mostrarFormularios() {
    if (filter_input(INPUT_GET, 'cambios')) {
        echo '<p>Sus cambios han sido realizados correctamente...';
    }
    echo '<p>Aquí podrás editar tu información personal. Rellena los campos que desees modificar...</p>';
    echo
    '<form action="editar.php" method="post">
            <p>Nombre: <input type="text" name="editar_nombre"/></p>
            <p>Email: <input type="text" name="editar_email"/></p>
            <p><input type = "submit" value = "Modificar" /></p>
    </form>';
    echo '<a href="password.php">Modificar mi contraseña</a>';
}

function usuarioLogueado() {
    return $_SESSION["identificado"];
}
