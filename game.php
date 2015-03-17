<?php

include_once './lib.php';

checkQuery();
$info = (new PDO('sqlite:./datos.db'))->query('SELECT NOMBRE,PLATAFORMA,DESCRIPCION,URL FROM JUEGOS WHERE ID=' . filter_input(INPUT_GET, 'id'));
View::start('Juego');
showGameInfo($info);
View::end();
exit(0);

function checkQuery() {
    if (!filter_input(INPUT_GET, 'id')) {
        header('Location: search.php');
        exit(1);
    }
}

function showGameInfo($info) {
    $available = (new PDO('sqlite:./datos.db'))->query('SELECT COUNT(*) FROM CAMBIABLES WHERE JUEGO=' . filter_input(INPUT_GET, 'id'))->fetchColumn(0);
    showAvailable($available);
    if ($info) {
        foreach ($info as $value) {
            echo "<h1>$value[nombre]</h1>";
            echo "<h3>Nombre</h3><p>$value[nombre]</p>";
            echo "<h3>Plataforma</h3><p>$value[plataforma]</p>";
            echo "<h3>Descripción</h3><p>$value[descripcion]</p>";
            echo "<h3>URL</h3><p><a href=$value[URL]>Página Oficial</a></p>";
        }
        session_start();
        if (in_array('id', $_SESSION)) {
            showExtraInfo();
        }
        session_write_close();
    } else {
        echo '<p>La página a la que intentas acceder no existe</p>';
    }
}

function showExtraInfo() {
    $cantidad = (new PDO('sqlite:./datos.db'))->query('SELECT COUNT(*) FROM CAMBIABLES WHERE JUEGO=' . filter_input(INPUT_GET, 'id'))->fetchColumn(0);
    echo "<h3>Cantidad</h3><p>Actualmente tenemos $cantidad[0] ejemplares del juego seleccionado...</p>";
    echo '<h3>Prestamistas</h3>';

    if ($cantidad == 0) {
        echo '<p>Actualmente no disponemos de ningún prestamista para ti...</p>';
    } else {
        echo '<p>A continuación te mostramos los correos de las personas que poseen el juego para que te puedas poner en contacto con ellos:</p>';
    }

    $aux = (new PDO('sqlite:./datos.db'))->query('SELECT USUARIO FROM CAMBIABLES WHERE JUEGO=' . filter_input(INPUT_GET, 'id'));
    if ($aux) {
        $taken = FALSE;
        foreach ($aux as $value) {
            if ($value['usuario'] == $_COOKIE['userid']) {
                $taken = TRUE;
            }
            showOwner($value['usuario']);
        }
        offerDesofrecer($taken);
    }
}

function showOwner($owner) {
    echo '<p>' . (new PDO('sqlite:./datos.db'))->query('SELECT EMAIL FROM USUARIOS WHERE ID=' . $owner)->fetchColumn(0) . '</p>';
}

function offerDesofrecer($taken) {
    $query = '.php?game=' . filter_input(INPUT_GET, 'id');
    if ($taken === TRUE) {
        $url = 'desofrecer_game' . $query;
        echo "<a href=$url>Quiero dejar de ofrecer este juego</a>";
    } else {
        $url = 'offer_game' . $query;
        echo "<a href=$url>Quiero ofrecer este juego</a>";
    }
}

function showAvailable($available) {
    if ($available !== '0') {
        echo '<p>Actualmente disponemos de ejemplares de este juego para intercambio</p>';
    } else {
        echo '<p>Actualmente no disponemos de ejemplares de este juego para intercambio</p>';
    }
}
