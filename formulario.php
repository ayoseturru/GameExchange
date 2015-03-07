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

    public static function formularioBorrarUusuario() {
        return '<form action="borrar_usuario.php" method="post">
            <fieldset>
            <legend>Eliminar Uusuario</legend>
            <p>
                Escriba el username del usuario que desea eliminar <input type="text" name="borrar_usuario"/>
                <input type="submit" value="Eliminar">
            </p>
            </fieldset>
        </form>';
    }

    public static function formularioAñadirJuego() {
        $db = new PDO('sqlite:./datos.db');
        $size = $db->query('select count(*) from juegos')->fetchColumn(0);
        $games = $db->query('SELECT ID,NOMBRE FROM JUEGOS');
        $a = '';
        if ($games) {
            foreach ($games as $value) {
                $a = $a . "<option value=$value[id]>$value[nombre]</option>";
            }
        }
        return "<form action='eliminar_juego.php' method='post'>
                <fieldset>
                <legend>Eliminar Juego</legend>
                <select name='juego_seleccionado' size=$size multiple='multiple'>
                <optgroup label='Juegos'>
                $a
                </optgroup>
                </select><br />
                <input type='submit' value='Eliminar' />
                </fieldset>
                </form>";
    }

    public static function formularioAñadirModificarJuego() {
        return '<form action="anadir_modificar_juego.php" method="post">
            <div>
                <fieldset>
                <p>
                Escriba el nombre del juego y la información que desee añadir. Si el juego no se encuentra se añadirá.
                </p>
                <legend>Añadir o modificar un juego</legend>
                <p>Nombre: <input type="text" name="anadir_modificar_nombre"></p>
                <p>Plataforma: <input type="text" name="anadir_modificar_plataforma"></p>
                <p>Descripción: <input type="text" name="anadir_modificar_descripcion"></p>
                <p>URL: <input type="text" name="anadir_modificar_url"></p>
                <input type="submit" value="Añadir / Modificar">
                </fieldset>
             </div>
        </form>';
    }

}
