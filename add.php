<?php
require 'require/_bdd.php';

$query = $dbCo->prepare("INSERT INTO task (task_description) VALUES (:description)");

$isOk = $query->execute([
    'description' => (strip_tags($_POST['description'])),
]);

header('location: todo.php?msg=' . ($isOk ? "Ok" : "NotOk"));
exit;

?>