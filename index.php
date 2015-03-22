<?php

include_once 'lib.php';
include_once './MyForm.php';
View::start('Club de Intercambio de Videojuegos');
echo MyForm::searchForm();
$db = new PDO("sqlite:./datos.db");
$db->exec('PRAGMA foreign_keys = ON;');
$cuantity = $db->query('SELECT COUNT(*) FROM juegos')->fetchColumn(0);
$res = $db->prepare('SELECT ID,NOMBRE,PLATAFORMA, DESCRIPCION, URL FROM juegos;');
$res->execute();
$jump = 0;
if ($res) {
    $res->setFetchMode(PDO::FETCH_NAMED);
    $first = true;
    foreach ($res as $game) {
        if ($first) {
            echo "<h2>últimos juegos añadidos</h2><table><tr>";
            foreach ($game as $field => $value) {
                if ($first) {
                    $first = FALSE;
                    continue;
                }
                echo "<th>$field</th>";
            }
            $first = false;
            echo "</tr>";
        }

        if ($jump < $cuantity - 5) {
            $jump = $jump + 1;
            continue;
        }

        echo "<tr>
               <td><a href=\"game.php?id=$game[id]\">$game[nombre]</a></td>
               <td>$game[plataforma]</td><td>$game[descripcion]</td>
               <td><a href=$game[URL]>$game[URL]</a></td>
            </tr>";
    }
    echo '</table>';
}
View::end();
