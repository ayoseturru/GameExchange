<?php

class View {

    public static function start($title) {
        $html = "<!DOCTYPE html>
<html>
<head>
<meta charset=\"utf-8\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"estilos.css\">
<title>$title</title>
</head>
<body>";
        echo $html;
        (new View())->mostrarHeader();
    }

    public static function end() {
        echo '</body>
</html>';
    }

    private function mostrarHeader() {
        session_start();
        $cuarto = 'Nosotros';
        $cuartoDireccion = 'info.php';
        if (in_array('identificado', $_SESSION)) {
            $accion = "Salir";
            $direccion = "desconexion.php";
            $cuarto = "Perfil";
            $cuartoDireccion = "gestion_perfil.php";
        } else {
            $accion = "Identificarse";
            $direccion = "login.php";
        }
        
        echo
        "<header><div>
                <li> <a href='index.php'>Portada</a></li>
                <li> <a href='buscar.php'>Buscar</a></li>
                <li> <a href=$direccion>$accion</a></li>
                <li> <a href=$cuartoDireccion>$cuarto</a></li>
        </div></header>";
        (new View())->admin();
        session_write_close();
    }
    
    function admin() {
        if(in_array('identificado', $_SESSION) and $_SESSION["id"] == 1 ) {
            echo "<a href='gestion.php'>Administración<a>";
        }
    }
}
