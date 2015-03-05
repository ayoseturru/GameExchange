<?php

include_once './lib.php';
;

comprobarQuery();

$fila = (new SQLite3('datos.db'))->query('SELECT NOMBRE,PLATAFORMA,DESCRIPCION,URL FROM JUEGOS WHERE ID=' . filter_input(INPUT_GET, 'id'))->fetchArray();
View::start($fila[0]);
mostrarInfoJuego($fila);
View::end();
exit(0);

function comprobarQuery() {
    if (!filter_input(INPUT_GET, 'id')) {
        header('Location: buscar.php');
        exit(1);
    }
}

function mostrarInfoJuego($fila) {
    if ($fila === FALSE) {
        echo '<p>La página a la que intenta acceder no existe...</p>';
    } else {
        echo "<h1>$fila[0]</h1>";
        echo "<h3>Nombre</h3><p>$fila[0]</p>";
        echo "<h3>Plataforma</h3><p>$fila[1]</p>";
        echo "<h3>Descripción</h3><p>$fila[2]</p>";
        echo "<h3>URL</h3><p><a href=$fila[3]>Página Oficial</a></p>";
        session_start();
        if (in_array('id', $_SESSION)) {
            mostrarInfoExtra();
        }
        session_write_close();
    }
}

function mostrarInfoExtra() {
    $cantidad = (new SQLite3('datos.db'))->query('SELECT * FROM CAMBIABLES WHERE JUEGO=' . filter_input(INPUT_GET, 'id'))->fetchArray();
    echo "<h3>Cantidad</h3><p>Actualmente tenemos $cantidad[0] ejemplares del juego seleccionado...</p>";
    $aux = (new SQLite3('datos.db'))->query('SELECT USUARIO FROM CAMBIABLES WHERE JUEGO=' . filter_input(INPUT_GET, 'id'));
    echo '<h3>Prestamistas</h3>';
    echo '<p>A continuación te mostramos los correos de las personas que poseen el juego para que te puedas poner en contacto con ellos:<p>';
    $prestado = FALSE;
    while ($row = $aux->fetchArray()) {
        if ($row[0] == $_COOKIE['idusuario']) {
            $prestado = TRUE;
            continue;
        }
        imprimirPrestamista($row[0]);
    }
    ofrecerDesofrecer($prestado);
}

function imprimirPrestamista($prestamista) {
    echo (new SQLite3('datos.db'))->query('SELECT EMAIL FROM USUARIOS WHERE ID=' . $prestamista)->fetchArray()[0] . '<br>';
}

function ofrecerDesofrecer($prestado) {
    $query = '.php?game=' . filter_input(INPUT_GET, 'id');
    if ($prestado === TRUE) {
        $url = 'quitar_juego' . $query;
        echo "<a href=$url>Quiero dejar de ofrecer este juego</a>";
    } else {
        $url = 'ofrecer_juego' . $query;
        echo "<a href=$url>Quiero ofrecer este juego</a>";
    }
}
