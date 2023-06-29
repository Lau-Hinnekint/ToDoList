<?php
require 'require/_bdd.php';


$query = $dbCo->prepare("INSERT INTO task (task_creation_date, task_description, task_order, ID_status)
                        VALUES (NOW(), :description, 1, 1)");

$isOk = $query->execute([
    'description' => (strip_tags($_POST['description'])),
]);

header('location: todo.php?msg=' . ($isOk ? "Ok" : "NotOk"));
exit;

?>