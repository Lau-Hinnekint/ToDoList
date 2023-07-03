<?php

require 'require/_bdd.php';


// ######################### ADD TASK FUNCTION #########################
if (isset($_REQUEST) && $_REQUEST['action'] === 'add') {
$query = $dbCo->prepare("INSERT INTO task (task_creation_date, task_description, task_order, ID_status)
                        VALUES (NOW(), :description, 1, 1)");

$isOk = $query->execute([
    'description' => (strip_tags($_POST['description'])),
]);

header('location: todo.php?msg=' . ($isOk ? "Ok" : "NotOk"));
exit;
}
// #####################################################################


######################### MODIFY STATUS FUNCTION #########################
if (isset($_REQUEST) && $_REQUEST['action'] === 'modify') {

    $query2 = $dbCo->prepare("UPDATE task SET id_status = 2 WHERE id_task = :id_task");

    if ($_REQUEST['ids'] === '1') {
        $query2->execute(['id_task' => $_GET['idt']]);
        header('Location: todo.php?msg=Ok');
    } else {
        header('Location: todo.php');
    }
exit;     
}   
// #####################################################################

?>