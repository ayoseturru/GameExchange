<?php
session_start();
unset($_SESSION["identificado"]);
unset($_SESSION["usuario"]);
unset($_SESSION["id"]);
unset($_COOKIE["nombre"]);
session_write_close();
header('Location: index.php');
exit(0);