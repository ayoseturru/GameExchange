<?php

include_once './lib.php';
include_once './formulario.php';

View::start('Búsqueda');

echo '<h1>BÚSQUEDA DE VIDEOJUEGOS</h1>';

echo Formulario::formularioBuscar();

if (filter_input(INPUT_POST, 'busqueda') === '') {
    busquedaNoExitosa(false);
} else {
    buscar();
}

View::end();

exit(0);

function buscar() {
    $results = (new SQLite3('datos.db'))->query('SELECT nombre,id FROM juegos');
    $firstTime = TRUE;
    while ($row = $results->fetchArray()) {
        if (stripos($row[0], filter_input(INPUT_POST, 'busqueda')) === FALSE) {
            continue;
        } else {
            if ($firstTime) {
                echo '<h2>Resultados de la búsqueda</h2>';
                $firstTime = FALSE;
            }
            $url = "juego.php?id=$row[1]";
            echo "<a href=$url>$row[0]</a>";
        }
    }
}

function busquedaNoExitosa() {
    echo '<p>Introduzca un texto en el buscador...</p>';
}
