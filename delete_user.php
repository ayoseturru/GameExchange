<?php

if (filter_input(INPUT_POST, 'delete_user')) {
    deleteUser();
    exit(0);
} else {
    header('Location: manager.php?code=1');
    exit(1);
}

function deleteUser() {
    $db = new PDO("sqlite:./datos.db");
    $db->exec('PRAGMA foreign_keys = ON;');
    if ($db->query('SELECT USUARIO FROM USUARIOS WHERE USUARIO=' . '"' . filter_input(INPUT_POST, 'delete_user') . '"')->fetchColumn(0)) {
        $db->query('DELETE FROM USUARIOS WHERE USUARIO=' . '"' . filter_input(INPUT_POST, 'delete_user') . '"');
        header('Location: manager.php?code=2');
        exit(0);
    } else {
        header('Location: manager.php?code=-1');
    }
}
