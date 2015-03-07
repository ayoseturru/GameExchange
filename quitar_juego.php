<?php

$inst = (new PDO('sqlite:./datos.db'))->prepare('DELETE FROM CAMBIABLES WHERE USUARIO=? AND JUEGO=?');
$res = $inst->execute(array($_COOKIE["idusuario"], filter_input(INPUT_GET, 'game')));
header('Location:juego.php?id=' . filter_input(INPUT_GET, 'game'));
exit(0);