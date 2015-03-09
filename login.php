<?php

include_once './lib.php';
include_once './MyForm.php';

View::start('Login');

previous();

echo MyForm::loginForm();

View::end();

function previous() {
    switch (filter_input(INPUT_GET, 'error')) {
        case 1:
            echo '<p>Asegúrese de haber rellenado ambos campos...</p>';
            break;
        case 2:
            echo 
            '<p>No se puede determinar que las credenciales proporcionadas sean auténticas. Por favor,'
            . ' vuelva a intentarlo...</p>';
            break;
        default:
            break;
    }
}