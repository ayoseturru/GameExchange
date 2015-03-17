<?php

if (filter_input(INPUT_POST, 'add_modify_game')) {
    $aux = exists();
    // Si el juego no existe, se registra en el sistema, en caso contrario se actualizan los campos escritos.
    if ($aux === FALSE) {
        introduce();
    } else {
        update($aux);
        header('Location: manager.php?code=6');
    }
    header('Location: manager.php?code=6');
    exit(0);
} else {
    header('Location: manager.php?code=5');
    exit(1);
}


 // Devuelve FALSE en caso de que un juego no exista o el nombre del mismo encaso contrario.

function exists() {
    $res = (new PDO("sqlite:./datos.db"))->query('SELECT NOMBRE FROM JUEGOS');
    if ($res) {
        foreach ($res as $value) {
            if (strcasecmp($value['nombre'], filter_input(INPUT_POST, 'add_modify_game')) === 0) {
                return $value['nombre'];
            }
        }
    }
    return FALSE;
}

// Actualiza los campos de un juego existente en el sistema.
function update($nombre) {
    $db = new PDO('sqlite:./datos.db');
    updatePlatform($db, $nombre);
    updateDescription($db, $nombre);
    updateURL($db, $nombre);
}

// Registra la plataforma de un juego en el sistema.
function updatePlatform($db, $nombre) {
    if (filter_input(INPUT_POST, 'add_modify_platform')) {
        $a = $db->prepare('UPDATE JUEGOS SET PLATAFORMA=? WHERE NOMBRE=?');
        $a->execute(array(filter_input(INPUT_POST, 'add_modify_platform'), $nombre));
    }
}

// Registra la descripción de un juego en el sistema.
function updateDescription($db, $nombre) {
    if (filter_input(INPUT_POST, 'add_modify_description')) {
        $a = $db->prepare('UPDATE JUEGOS SET DESCRIPCION=? WHERE NOMBRE=?');
        $a->execute(array(filter_input(INPUT_POST, 'add_modify_description'), $nombre));
    }
}

// Registra la URL de un juego en el sistema.
function updateURL($db, $nombre) {
    if (filter_input(INPUT_POST, 'add_modify_url')) {
        $a = $db->prepare('UPDATE JUEGOS SET URL=? WHERE NOMBRE=?');
        $a->execute(array(filter_input(INPUT_POST, 'add_modify_url'), $nombre));
    }
}

// Registra un juego nuevo en el sistema.
function introduce() {
    $db = new PDO('sqlite:./datos.db');
    introduceGame($db);
    updateDescription($db, filter_input(INPUT_POST, 'add_modify_game'));
    updateURL($db, filter_input(INPUT_POST, 'add_modify_game'));
    updatePlatform($db, filter_input(INPUT_POST, 'add_modify_game'));
}

// Registra el nombre de un juego en el sistema.
function introduceGame($db) {
    if (filter_input(INPUT_POST, 'add_modify_game')) {
        $a = $db->prepare('INSERT INTO JUEGOS (NOMBRE) VALUES(?)');
        $a->execute(array(filter_input(INPUT_POST, 'add_modify_game')));
    }
}
