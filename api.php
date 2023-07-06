<?php

require 'require/_bdd.php';

header('Content-type: application/json');

session_start();

$data = json_decode(file_get_contents('php://input'), true);

$isOk = false;


if (
    !array_key_exists('token', $_SESSION) || !array_key_exists('token', $data)
    || $_SESSION['token'] !== $data['token']
) {
    echo json_encode([
        'result' => 'false',
        'error' => 'Accès refusé, jeton invalide.'
    ]);
    exit;
}


if (!empty($data) && $data['action'] === 'edit' && $_SERVER['REQUEST_METHOD'] === 'PUT') {

    $id = (int)strip_tags($data['idTask']);
    $desc = trim(strip_tags($data['desc']));

    $query = $dbCo->prepare('UPDATE task SET task_description = :desc WHERE ID_task = :idTask');
    $isOk = $query->execute([
        'desc' => $desc,
        'idTask' => $id
    ]);
    
    echo json_encode([
        'result' => $isOk && $query->rowCount() > 0,
        'idTask' => $id,
        'desc' => $desc,
    ]);
    exit;
}