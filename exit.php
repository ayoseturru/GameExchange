<?php

// Borra las cookies y datos de la variable $_SESSION que identificaban a un usuario logueado.
session_start();
unset($_SESSION["identify"]);
unset($_SESSION["username"]);
unset($_SESSION["type"]);
unset($_COOKIE["name"]);
session_write_close();
header('Location: index.php');
exit(0);