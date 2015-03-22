<?php

include_once './lib.php';

View::start('Política');
echo '<h1 class="center">www.intercambiodevideojuegos.com</h1>';
echo 
'<p class="infop">En primer lugar hemos de informarte que en caso de decidir registrarse, estará permitiendo que enviemos cookies a su navegador.
    Las cuales serán utilizadas por nosotros con el único propósito de crear una navegación más personalizada.    
</p>';
echo '<h2 class="center">¿Qué son las cookies?</h2>';
echo '<p class="infop">Una cookie (o galleta informática) es una pequeña información enviada por un sitio web y almacenada en el navegador del usuario, de manera que el sitio web puede consultar la actividad previa del usuario.</p>';
echo '<h2 class="center">¿Qué tipo de cookies vamos a utilizar?</h2>';
echo '<p class="infop">Cookies técnicas: Son aquéllas que permiten al usuario la navegación a través de una página web, plataforma'
. ' o aplicación y la utilización de las diferentes opciones o servicios que en ella existan como, por ejemplo, '
        . 'controlar el tráfico y la comunicación de datos, identificar la sesión, acceder a partes de acceso restringido </p>';
echo
'<h2 class="center">Datos personales</h2><p class="infop">
    Esta organización no realiza el almacenamiento de las claves personales de forma directa. Se almeacenan utilizando algoritmos de resumenes
    irreversibles. Esto quiere decir que en caso de ataque y si alguien tuviera acceso a nuestro sistema de almacenamiento, no podría descifrar las claves.
</p>';
View::end();
