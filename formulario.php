<?php

class Formulario {
    public static function formularioBuscar() {
        return '<form action="buscar.php" method="post">
            <p>
                Escriba el nombre del juego a buscar: <input type="search" name="busqueda"/>
                <input type="submit" value="Buscar">
            </p>
        </form>';
    }
}
