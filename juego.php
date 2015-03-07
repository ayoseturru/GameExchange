<?php

include_once './lib.php';

comprobarQuery();
$info = (new PDO('sqlite:./datos.db'))->query('SELECT NOMBRE,PLATAFORMA,DESCRIPCION,URL FROM JUEGOS WHERE ID=' . filter_input(INPUT_GET, 'id'));
View::start('Juego');
mostrarInfoJuego($info);
View::end();
exit(0);

function comprobarQuery() {
    if (!filter_input(INPUT_GET, 'id')) {
        header('Location: buscar.php');
        exit(1);
    }
}

function mostrarInfoJuego($info) {
    if ($info) {
        foreach ($info as $valor) {
            echo "<h1>$valor[nombre]</h1>";
            echo "<h3>Nombre</h3><p>$valor[nombre]</p>";
            echo "<h3>Plataforma</h3><p>$valor[plataforma]</p>";
            echo "<h3>Descripción</h3><p>$valor[descripcion]</p>";
            echo "<h3>URL</h3><p><a href=$valor[URL]>Página Oficial</a></p>";
        }
        session_start();
        if (in_array('id', $_SESSION)) {
            mostrarInfoExtra();
        }
        session_write_close();
    } else {
        echo '<p>La página a la que intentas acceder no existe</p>';
    }
}

function mostrarInfoExtra() {
    $cantidad = (new PDO('sqlite:./datos.db'))->query('SELECT * FROM CAMBIABLES WHERE JUEGO=' . filter_input(INPUT_GET, 'id'))->fetchColumn(0);
    echo "<h3>Cantidad</h3><p>Actualmente tenemos $cantidad[0] ejemplares del juego seleccionado...</p>";
    echo '<h3>Prestamistas</h3>';
    echo '<p>A continuación te mostramos los correos de las personas que poseen el juego para que te puedas poner en contacto con ellos:<p>';
    $aux = (new PDO('sqlite:./datos.db'))->query('SELECT USUARIO FROM CAMBIABLES WHERE JUEGO=' . filter_input(INPUT_GET, 'id'));
    if ($aux) {
        $prestado = FALSE;
        foreach ($aux as $valor) {
            if ($valor['usuario'] == $_COOKIE['idusuario']) {
                $prestado = TRUE;
                continue;
            }
            imprimirPrestamista($valor['usuario']);
        }
        ofrecerDesofrecer($prestado);
    }
}

function imprimirPrestamista($prestamista) {
    echo (new PDO('sqlite:./datos.db'))->query('SELECT EMAIL FROM USUARIOS WHERE ID=' . $prestamista)->fetchColumn(0) . '<br>';
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
