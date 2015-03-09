<?php
session_start();
unset($_SESSION["identify"]);
unset($_SESSION["username"]);
unset($_SESSION["type"]);
unset($_COOKIE["name"]);
session_write_close();
header('Location: index.php');
exit(0);