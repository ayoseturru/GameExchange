<?php

include_once './lib.php';
View::start('Página Principal');

session_start();

if ($_SESSION["identificado"]) {
    mostrarContenido();
} else {
    header("Location:login.php");
}

session_write_close();
View::end();

function mostrarContenido() {
    echo '<a href="gestion_perfil.php">Editar mi información personal</a>';
    echo '<a href="password.php">Modificar mi contraseña</a>';
    echo "<p>Hola, {$_COOKIE["nombre"]}</p>";
}
