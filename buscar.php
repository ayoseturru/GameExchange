<?php

include_once './lib.php';
include_once './formulario.php';

View::start('Búsqueda');

echo '<h1>BÚSQUEDA DE VIDEOJUEGOS</h1>';

echo Formulario::formularioBuscar();

if (filter_input(INPUT_POST, 'busqueda') === '') {
    failSearch(false);
} else {
    search();
}

View::end();

exit(0);

function search() {
    $result = (new PDO("sqlite:./datos.db"))->query('SELECT nombre,id FROM juegos');
    $first = TRUE;
    if ($result) {
        foreach ($result as $value) {
            if (stripos($value['nombre'], filter_input(INPUT_POST, 'busqueda')) === FALSE) {
                continue;
            } else {
                if ($first) {
                    echo '<h2>Resultados de la búsqueda</h2>';
                    $first = FALSE;
                }
                $url = "juego.php?id=$value[id]";
                echo "<a href=$url>$value[nombre]</a>";
            }
        }
    }
}

function failSearch() {
    echo '<p>Introduzca un texto en el buscador...</p>';
}
