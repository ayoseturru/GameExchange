<?php

include_once 'lib.php';
View::start('Club de Intercambio de Videojuegos');
echo '<a href="login.php">Acceso</a>';
echo '<form action="buscar.php" method="post">
            <p>
                Escriba el nombre del juego a buscar: <input type="search" name="busqueda"/>
                <input type="submit" value="Buscar">
            </p>
        </form>';
$db = new PDO("sqlite:./datos.db");
$db->exec('PRAGMA foreign_keys = ON;');
$res = $db->prepare('SELECT * FROM juegos;');
$res->execute();
if ($res) {
    $res->setFetchMode(PDO::FETCH_NAMED);
    $first = true;
    foreach ($res as $game) {
        if ($first) {
            echo "<table><tr>";
            foreach ($game as $field => $value) {
                echo "<th>$field</th>";
            }
            $first = false;
            echo "</tr>";
        }
        echo "<tr>";
        foreach ($game as $value) {
            echo "<th>$value</th>";
        }
        echo "</tr>";
    }
    echo '</table>';
}
View::end();
