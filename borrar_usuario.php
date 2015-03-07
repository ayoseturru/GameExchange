<?php

if (filter_input(INPUT_POST, 'borrar_usuario')) {
    deleteUser();
    exit(0);
} else {
    header('Location: gestion.php?codigo=1');
    exit(1);
}

function deleteUser() {
    $db = new PDO("sqlite:./datos.db");
    $db->exec('PRAGMA foreign_keys = ON;');
    if ($db->query('SELECT USUARIO FROM USUARIOS WHERE USUARIO=' . '"' . filter_input(INPUT_POST, 'borrar_usuario') . '"')->fetchColumn(0)) {
        $db->query('DELETE FROM USUARIOS WHERE USUARIO=' . '"' . filter_input(INPUT_POST, 'borrar_usuario') . '"');
        header('Location: gestion.php?codigo=2');
        exit(0);
    } else {
        header('Location: gestion.php?codigo=7');
    }
}
