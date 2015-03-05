<?php

(new SQLite3('datos.db'))->exec('DELETE FROM CAMBIABLES WHERE USUARIO=' . $_COOKIE["idusuario"] . ' AND JUEGO='
        . filter_input(INPUT_GET, 'game'));
header('Location:juego.php?id=' . filter_input(INPUT_GET, 'game'));
header('Location:juego.php?id=' . filter_input(INPUT_GET, 'game'));
