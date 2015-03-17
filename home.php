<?php

include_once './lib.php';
View::start('Página Principal');

session_start();

if ($_SESSION["identify"]) {
    previous();
    showElements();
} else {
    header("Location:login.php");
}

session_write_close();
View::end();

// Muestra el contenido de la página.
function showElements() {
    echo "<p>Hola, {$_COOKIE["name"]}</p>";
    echo showDesofrecerGameForm();
}

// Devuelve un formulario con los juegos ofrecidos por el usuario logueado para desofrecerlos si se desea.
function showdesofrecerGameForm() {
    $db = new PDO('sqlite:./datos.db');
    $size = $db->query('select count(*) from cambiables')->fetchColumn(0);
    $games = $db->query('SELECT USUARIO,JUEGO FROM CAMBIABLES WHERE USUARIO=' . $_COOKIE["userid"]);
    $a = '';
    if ($games) {
        foreach ($games as $value) {
            $name = $db->query('SELECT NOMBRE FROM JUEGOS WHERE ID=' . $value['juego'])->fetchColumn(0);
            $a = $a . "<option value=$value[juego]>$name</option>";
        }
    }
    return "<form action='desofrecer_game_home.php' method='post'>
                <fieldset>
                <legend>Mis juegos</legend>
                <select name='selected_game' size=$size multiple='multiple'>
                <optgroup label='Juegos'>
                $a
                </optgroup>
                </select><br />
                <input type='submit' value='Desofrecer' />
                </fieldset>
                </form>";
}

function previous() {
    switch (filter_input(INPUT_GET, 'goal')) {
        case 'yes':
            echo '<p>El juego se desofreció correctamente.</p>';
            break;
        case 'no':
            echo '<p>Seleccione un juego.</p>';
            break;
        default:
            break;
    }
}