<?php

class View {

    public static function start($title) {
        $html = "<!DOCTYPE html>
            <html>
                <head>
                    <meta charset=\"utf-8\">
                    <link rel=\"stylesheet\" type=\"text/css\" href=\"estilos.css\">
                    <script src=\"http://code.jquery.com/jquery-1.10.1.min.js\"></script>
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

    private static function showHeader() {
        echo "<a href='index.php'><img src = 'club.jpg'></a>";
        session_start();
        $first = "Portada";
        $firstPath= "index.php";
        $fourth = 'Nosotros';
        $fourthPath = 'info.php';
        $third = "Política";
        $thirdPath = "policy.php";
        if (in_array('identify', $_SESSION)) {
            $accion = "Salir";
            $path = "exit.php";
            $third = "Home";
            $thirdPath = "home.php";
            $fourth = "Perfil";
            $fourthPath = "edit_profile.php";
            if ($_SESSION["type"] == 1) {
                $first = "Home";
                $firstPath = "home.php";
                $third = "Administración";
                $thirdPath = "manager.php";
            }
        } else {
            $accion = "Acceso";
            $path = "login.php";
        }

        echo
        "<header>
                <li> <a href=$firstPath>$first</a></li>
                <li> <a href='search.php'>Buscar</a></li>
                <li> <a href=$thirdPath>$third</a></li>
                <li> <a href=$fourthPath>$fourth</a></li>
                <li> <a href=$path>$accion</a></li>
        </header>";
        session_write_close();
    }

}
