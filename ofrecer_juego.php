<?php

(new SQLite3('datos.db'))->exec('INSERT INTO CAMBIABLES(USUARIO,JUEGO) VALUES("' . $_COOKIE["idusuario"] .'","' . 
        filter_input(INPUT_GET, 'game') . '")');
header('Location:juego.php?id=' . filter_input(INPUT_GET, 'game'));
