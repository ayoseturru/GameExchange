<?php

include_once './lib.php';
View::start('Gestionar mi perfil');
session_start();

if (userIsLogin()) {
    showForms();
} else {
    session_write_close();
    header('Location:login.php');
    exit(1);
}

session_write_close();
View::end();
exit(0);

function showForms() {
    if (filter_input(INPUT_GET, 'changes')) {
        echo '<p>Sus cambios han sido realizados correctamente...';
    }
    echo '<p>Aquí podrás editar tu información personal. Rellena los campos que desees modificar...</p>';
    echo
    '<form action="edit.php" method="post">
        <fieldset>
            <p>Nombre: <input type="text" name="edit_name"/></p>
            <p>Email: <input type="text" name="edit_email"/></p>
            <p><input type = "submit" value = "Modificar" /></p>
         </fieldset>
    </form>';
    echo '<br><a href="password.php">Modificar mi contraseña</a>';
}

function userIsLogin() {
    return $_SESSION["identify"];
}
