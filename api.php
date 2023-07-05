<?php

require 'require/_bdd.php';

session_start();

$data = json_decode(file_get_contents('php://input'), true);

$isOk = false;


if (!array_key_exists('token', $_SESSION) || !array_key_exists('token', $data)
    || $_SESSION['token'] !== $data['token']) {
    header('content-type:application/json');
    echo json_encode([
        'result' => 'false',
        'error' => 'Accès refusé, jeton invalide.'
    ]);
    exit;
}


var_dump($data);