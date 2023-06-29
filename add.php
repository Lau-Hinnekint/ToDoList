<?php
require 'require/_bdd.php';

// $dateTime = time();
// $date =date("Y-m-d H:i:s", $dateTime) ;
// var_dump($date);


$query = $dbCo->prepare("INSERT INTO task (task_creation_date, task_description, task_order, ID_status)
                        VALUES (NOW(), :description, 1, 1)");

$isOk = $query->execute([
    'description' => (strip_tags($_POST['description'])),
]);

header('location: todo.php?msg=' . ($isOk ? "Ok" : "NotOk"));
exit;

?>