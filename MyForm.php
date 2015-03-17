<?php

class MyForm {

    public static function searchForm() {
        return '<form action="search.php" method="post">
            <fieldset>
            <legend>Búsqueda</legend>
            <p>
                Escriba el nombre del juego a buscar: <input type="search" name="busqueda"/>
                <input type="submit" value="Buscar">
            </p>
            </fieldset>
        </form>';
    }

    public static function eraseUserForm() {
        return '<form action="delete_user.php" method="post">
            <fieldset>
            <legend>Eliminar Usuario</legend>
            <p>
                Escriba el username del usuario que desea eliminar <input type="text" name="delete_user"/>
                <input type="submit" value="Eliminar">
            </p>
            </fieldset>
        </form>';
    }

    public static function deleteGameForm() {
        $db = new PDO('sqlite:./datos.db');
        $size = $db->query('select count(*) from juegos')->fetchColumn(0);
        $games = $db->query('SELECT ID,NOMBRE FROM JUEGOS');
        $a = '';
        if ($games) {
            foreach ($games as $value) {
                $a = $a . "<option value=$value[id]>$value[nombre]</option>";
            }
        }
        return "<form action='delete_game.php' method='post'>
                <fieldset>
                <legend>Eliminar Juego</legend>
                <select name='selected_game' size=$size multiple='multiple'>
                <optgroup label='Juegos'>
                $a
                </optgroup>
                </select><br />
                <input type='submit' value='Eliminar' />
                </fieldset>
                </form>";
    }

    public static function addModifyGameForm() {
        return '<form action="add_modify_game.php" method="post">
            <div>
                <fieldset>
                <p>
                Escriba el nombre del juego y la información que desee añadir. Si el juego no se encuentra se añadirá.
                </p>
                <legend>Añadir o modificar un juego</legend>
                <p>Nombre: <input type="text" name="add_modify_game"></p>
                <p>Plataforma: <input type="text" name="add_modify_platform"></p>
                <p>Descripción: <input type="text" name="add_modify_description"></p>
                <p>URL: <input type="text" name="add_modify_url"></p>
                <input type="submit" value="Añadir / Modificar">
                </fieldset>
             </div>
        </form>';
    }

    public static function signUpForm() {
        return
        '<form action = "register.php" method = "post">
            <fieldset>
            <legend>Registro</legend>
            <img src="registro.jpg">
            <p>¡Regístrate en un minuto rellenando el siguiente formulario!</p> 
            <p>Username: <input type = "text" name = "new_username" /></p>
            <p>Password: <input type = "password" name = "new_pass" /></p>
            <p>Password de nuevo: <input type = "password" name = "again_new_pass" /></p>
            <p>Nombre: <input type = "text" name = "new_name" /></p>
            <p>Email: <input type = "text" name = "new_email" /></p>
            <p><input type = "submit" value = "Entrar" /></p>
            </fieldset>
        </form>';
    }

    public static function editPasswordForm() {
        return
        '<form action = "edit_password.php" method = "post">
                <fieldset>
                <p>Antigua Contraseña: <input type = "password" name = "old_password" /></p>
                <p>Nueva Contraseña: <input type = "password" name = "new_password" /></p>
                <p>Otra vez su nueva contraseña: <input type = "password" name = "again_new_password" /></p>
                <p><input type = "submit" value="Modificar" /></p>
                </fieldset>
        </form>';
    }

    public static function loginForm() {
        return 
        '<form action = "sign_in.php" method = "post">
            <fieldset><legend>LOGIN</legend>
            <img src="key.jpg">
            <p>Username: <input type = "text" name = "username" /></p>
            <p>Password: <input type = "password" name = "password" /></p>
            <p><input type = "submit" value="Entrar" /></p>
        </form><p>¿Aún no tienes cuenta? ¡Pues regístrate!</p><a href="sign_up.php">Registro</a></fieldset>';
    }

}
