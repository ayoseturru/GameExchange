<?php

if (filter_input(INPUT_POST, 'juego_seleccionado')) {
    deleteGame();
    exit(0);
} else {
    header('Location: gestion.php?codigo=3');
    exit(1);
}

function deleteGame() {
    $db = new PDO("sqlite:./datos.db");
    $db->exec('PRAGMA foreign_keys = ON;');
    $db->query('DELETE FROM JUEGOS WHERE ID=' . filter_input(INPUT_POST, 'juego_seleccionado'));
    header('Location: gestion.php?codigo=4');
}
