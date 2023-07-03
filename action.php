<?php
session_start();
require 'require/_bdd.php';

if (!array_key_exists('HTTP_REFERER', $_SERVER)
    || str_contains($_SERVER['HTTP_REFERER'], 'http://localhost/todo.php/')) {
        header('Location: index?php?msg=error_referer');
        exit;
    }

else if (!array_key_exists('token', $_SESSION) || !array_key_exists('token', $_REQUEST)
        || $_SESSION['token'] !== $_REQUEST['token']) {
            header ('Location: index.php?msg= error_csrf');
            exit;
            }

// var_dump($_REQUEST);
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


// ######################### MODIFY STATUS FUNCTION #########################
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


// ######################### EDIT TASK #########################
if (isset($_REQUEST) && $_REQUEST['action'] === 'edit') {

    $query3 = $dbCo->prepare("UPDATE task SET task_description = :desc WHERE id_task = :id_task");
    
    if (isset($_REQUEST['desc'])) {
        $query3->execute([  'desc' => $_REQUEST['desc'],
                            'id_task' => $_REQUEST['idt']]);
        header('Location: todo.php?msg=Ok');
    } else {
        header('Location: todo.php?msg=NOk');
    }
exit;
}
#####################################################################

?>