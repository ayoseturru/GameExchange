<?php

$inst = (new PDO('sqlite:./datos.db'))->prepare('INSERT INTO cambiables (usuario,juego) VALUES (?, ?)');
$res = $inst->execute(array($_COOKIE["userid"], filter_input(INPUT_GET, 'game')));
header('Location:game.php?id=' . filter_input(INPUT_GET, 'game'));
exit(0);