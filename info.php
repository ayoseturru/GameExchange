<?php

include_once './lib.php';
View::start('Nosotros');
echo '<h1 class="center">www.intercambiodevideojuegos.com</h1>';
echo 
'<p class="infop">
    Somos una organizaciíon sin animo de lucro que tiene como objetivo que gente aficionada al mundo de los videojuegos puedan compartir
    sus juegos con otras personas.
</p>';
echo '<h2 class="center">¿Qué ofrecemos?</h2>';
echo '<p class="infop">Además de poder compartir tus juegos, puedes consultar información sobre juegos de todas las plataformas.
        Semanalmente actualizamos nuestro registro de juego, por lo que siempre estarás informado sobre todo lo que pasa en tu mundo virtual preferido.
        Si tu juego favorito no está en nuestro registro pudes mandarnos un correo y trataremos de introducirlo para que más gente pueda conocerlo.
</p>';
echo '<h2 class="center">¿Cómo contactar?</h2>';
echo '<p class="infop">
    Si desea contactar con nosotros mándenos un mensaje a admin@idv@com.
 </p>';
View::end();
