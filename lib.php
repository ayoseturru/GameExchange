<?php

class View {

    public static function start($title) {
        $html = "<!DOCTYPE html>
            <html>
                <head>
                    <meta charset=\"utf-8\">
                    <link rel=\"stylesheet\" type=\"text/css\" href=\"estilos.css\">
                    <link rel=\"stylesheet\" href=\"//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css\">
                    <script src=\"http://code.jquery.com/jquery-1.11.2.js\"></script>
                    <script src=\"http://code.jquery.com/ui/1.11.4/jquery-ui.js\"></script>
                    <script type=\"text/javascript\" src=\"scripts.js\"></script>
                    <title>$title</title>
                </head>
                <body>";
        echo $html;
        View::showHeader();
    }

    public static function end() {
        echo '</body></html>';
    }

    /*
     *  Función encargada de mostrar el header de navegación atendiendo al tipo de usuario que esté utilizando el servidor.
     */

    private static function showHeader() {
        echo '<a href="index.php"><img src = "club.jpg" alt="imagen del club"></a>';
        session_start();
        $first = "Portada";
        $firstPath = "index.php";
        $fourth = 'Nosotros';
        $fourthPath = 'info.php';
        $third = "Política";
        $thirdPath = "policy.php";
        if (isset($_SESSION['identify'])) {
            $accion = "Salir";
            $path = "exit.php";
            $third = "Home";
            $thirdPath = "home.php";
            $fourth = "Perfil";
            $fourthPath = "edit_profile.php";
            if ($_SESSION["type"] == 1) {
                $first = "Home";
                $firstPath = "home.php";
                $third = "Admin";
                $thirdPath = "manager.php";
            }
        } else {
            $accion = "Acceso";
            $path = "login.php";
        }

        echo
        "<nav>
                <ul>
                <li> <a href=$firstPath>$first</a></li>
                <li> <a href='search.php'>Buscar</a></li>
                <li> <a href=$thirdPath>$third</a></li>
                <li> <a href=$fourthPath>$fourth</a></li>
                <li> <a href=$path>$accion</a></li>
                </ul>
        </nav>";
        session_write_close();
    }

}
