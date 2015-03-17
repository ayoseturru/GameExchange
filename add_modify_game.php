<?php

if (filter_input(INPUT_POST, 'add_modify_game')) {
    $aux = exists();
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

function modify() {
    $db = new PDO("sqlite:./datos.db");
    $db->exec('PRAGMA foreign_keys = ON;');
    $db->query('DELETE FROM USUARIOS WHERE USUARIO=' . '"' . filter_input(INPUT_POST, 'delete_user') . '"');
    echo filter_input(INPUT_POST, 'delete_user');
    header('Location: manager.php?code=2');
}

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

function update($nombre) {
    $db = new PDO('sqlite:./datos.db');
    updatePlatform($db, $nombre);
    updateDescription($db, $nombre);
    updateURL($db, $nombre);
}

function updatePlatform($db, $nombre) {
    if (filter_input(INPUT_POST, 'add_modify_platform')) {
        $a = $db->prepare('UPDATE JUEGOS SET PLATAFORMA=? WHERE NOMBRE=?');
        $a->execute(array(filter_input(INPUT_POST, 'add_modify_platform'), $nombre));
    }
}

function updateDescription($db, $nombre) {
    if (filter_input(INPUT_POST, 'add_modify_description')) {
        $a = $db->prepare('UPDATE JUEGOS SET DESCRIPCION=? WHERE NOMBRE=?');
        $a->execute(array(filter_input(INPUT_POST, 'add_modify_description'), $nombre));
    }
}

function updateURL($db, $nombre) {
    if (filter_input(INPUT_POST, 'add_modify_url')) {
        $a = $db->prepare('UPDATE JUEGOS SET URL=? WHERE NOMBRE=?');
        $a->execute(array(filter_input(INPUT_POST, 'add_modify_url'), $nombre));
    }
}

function introduce() {
    $db = new PDO('sqlite:./datos.db');
    introduceGame($db);
    updateDescription($db, filter_input(INPUT_POST, 'add_modify_game'));
    updateURL($db, filter_input(INPUT_POST, 'add_modify_game'));
    updatePlatform($db, filter_input(INPUT_POST, 'add_modify_game'));
}

function introduceGame($db) {
    if (filter_input(INPUT_POST, 'add_modify_game')) {
        $a = $db->prepare('INSERT INTO JUEGOS (NOMBRE) VALUES(?)');
        $a->execute(array(filter_input(INPUT_POST, 'add_modify_game')));
    }
}
