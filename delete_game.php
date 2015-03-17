<?php
if (filter_input(INPUT_POST, 'selected_game')) {
    deleteGame();
    exit(0);
} else {
    header('Location: manager.php?code=3');
    exit(1);
}

// Borra en propagación un juego de todas las partes del sistema.
function deleteGame() {
    $db = new PDO("sqlite:./datos.db");
    $db->exec('PRAGMA foreign_keys = ON;');
    $db->query('DELETE FROM JUEGOS WHERE ID=' . filter_input(INPUT_POST, 'selected_game'));
    header('Location: manager.php?code=4');
}
