<?php

$res = new stdClass();
$res->exists = false;
$res->message = ''; 
try {
    $allData = file_get_contents("php://input");
    $data = json_decode($allData);
    $db = new PDO("sqlite:./datos.db");
    $db->exec('PRAGMA foreign_keys = ON;'); 
    $sql = $db->query('SELECT NOMBRE FROM USUARIOS WHERE USUARIO="' . $data->username .'"');
    if ($sql) {
        $a = $sql->fetchColumn();
        if ($a !== FALSE) { 
            $res->exists = true; 
        } else {
            $res->message = "El username está disponible";
        }
    } else {
        $res->message = 'No se ha podido preparar la instrucción SQL';
    }
} catch (Exception $e) {
    $res->message = "Se ha producido una excepción en el servidor: " . $e->getMessage();
}
header('Content-type: application/json');
echo json_encode($res);
