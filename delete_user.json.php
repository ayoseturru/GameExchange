<?php

$res = new stdClass();
$res->exists = false;
$res->message = ''; 
try {
    $allData = file_get_contents("php://input");
    $data = json_decode($allData);
    $db = new PDO("sqlite:./datos.db");
    $db->exec('PRAGMA foreign_keys = ON;');
    
    if($db->query('SELECT * FROM USUARIOS WHERE USUARIO="' . $data->username .'"')->fetchColumn()) {
        $res->exists = true;
    } else {
        $res->exists = false;
    }
    
    $sql = $db->query('DELETE FROM USUARIOS WHERE USUARIO="' . $data->username .'"');
    if ($sql) {
        if($res->exists) {
            $res->message = "Usuario eliminado";
        } else {
            $res->message = "El usuario no existe";
        }
    } else {
        $res->message = 'No se ha podido preparar la instrucción SQL';
    }
} catch (Exception $e) {
    $res->message = "Se ha producido una excepción en el servidor: " . $e->getMessage();
}
header('Content-type: application/json');
echo json_encode($res);
