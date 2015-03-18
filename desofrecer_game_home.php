<?php

/*
 * Desofrece un juego ofrecido previamente por el usuario logueado.
 */
if (isset($_POST['selected_game'])) {
    $inst = (new PDO('sqlite:./datos.db'))->prepare('DELETE FROM CAMBIABLES WHERE USUARIO=? AND JUEGO=?');
    $res = $inst->execute(array($_COOKIE["userid"], filter_input(INPUT_POST, 'selected_game')));
    header('Location:home.php?goal=yes');
    exit(0);
} else {
    header('Location:home.php?goal=no');
    exit(1);
}