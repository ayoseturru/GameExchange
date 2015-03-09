<?php

include_once 'lib.php';
include_once './MyForm.php';
View::start('Registro');

previous();
echo MyForm::signUpForm();
View::end();

function previous() {
    switch (filter_input(INPUT_GET, 'register')) {
        case 1:
            echo '<p>Asegúrese de haber rellenado todos los campos...</p>';
            break;
        case 2:
            echo '<p>La clave debe tener una longitud mínima de 8 caracteres...</p>';
            break;
        case 3:
            echo '<p>El username ya está usado...</p>';
            break;
        case 4:
            echo '<p>Las claves no coinciden...</p>';
            break;
        default:
            break;
    }
}
