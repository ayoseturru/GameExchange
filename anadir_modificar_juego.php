<?php

if (filter_input(INPUT_POST, 'anadir_modificar_nombre')) {
    $aux = existe();
    if ($aux === FALSE) {
        introducir();
    } else {
        actualizar($aux);
        header('Location: gestion.php?codigo=6');
    }
    header('Location: gestion.php?codigo=6');
    exit(0);
} else {
    header('Location: gestion.php?codigo=5');
    exit(1);
}

function modificar() {
    $db = new PDO("sqlite:./datos.db");
    $db->exec('PRAGMA foreign_keys = ON;');
    $db->query('DELETE FROM USUARIOS WHERE USUARIO=' . '"' . filter_input(INPUT_POST, 'borrar_usuario') . '"');
    echo filter_input(INPUT_POST, 'borrar_usuario');
    header('Location: gestion.php?codigo=2');
}

function existe() {
    $res = (new PDO("sqlite:./datos.db"))->query('SELECT NOMBRE FROM JUEGOS');
    if ($res) {
        foreach ($res as $value) {
            if (strcasecmp($value['nombre'], filter_input(INPUT_POST, 'anadir_modificar_nombre')) === 0) {
                return $value['nombre'];
            }
        }
    }
    return FALSE;
}

function actualizar($nombre) {
    $db = new PDO('sqlite:./datos.db');
    actualizarPlataforma($db, $nombre);
    actualizarDescripcion($db, $nombre);
    actualizarURL($db, $nombre);
}

function actualizarPlataforma($db, $nombre) {
    if (filter_input(INPUT_POST, 'anadir_modificar_plataforma')) {
        $a = $db->prepare('UPDATE JUEGOS SET PLATAFORMA=? WHERE NOMBRE=?');
        $a->execute(array(filter_input(INPUT_POST, 'anadir_modificar_plataforma'), $nombre));
    }
}

function actualizarDescripcion($db, $nombre) {
    if (filter_input(INPUT_POST, 'anadir_modificar_descripcion')) {
        $a = $db->prepare('UPDATE JUEGOS SET DESCRIPCION=? WHERE NOMBRE=?');
        $a->execute(array(filter_input(INPUT_POST, 'anadir_modificar_descripcion'), $nombre));
    }
}

function actualizarURL($db, $nombre) {
    if (filter_input(INPUT_POST, 'anadir_modificar_url')) {
        $a = $db->prepare('UPDATE JUEGOS SET URL=? WHERE NOMBRE=?');
        $a->execute(array(filter_input(INPUT_POST, 'anadir_modificar_url'), $nombre));
    }
}

function introducir() {
    $db = new PDO('sqlite:./datos.db');
    introducirNombre($db);
    actualizarDescripcion($db, filter_input(INPUT_POST, 'anadir_modificar_nombre'));
    actualizarURL($db, filter_input(INPUT_POST, 'anadir_modificar_nombre'));
    actualizarPlataforma($db, filter_input(INPUT_POST, 'anadir_modificar_nombre'));
}

function introducirNombre($db) {
    if (filter_input(INPUT_POST, 'anadir_modificar_nombre')) {
        $a = $db->prepare('INSERT INTO JUEGOS (NOMBRE) VALUES(?)');
        $a->execute(array(filter_input(INPUT_POST, 'anadir_modificar_nombre')));
    }
}
