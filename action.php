<?php
session_start();
require 'require/_bdd.php';

// var_dump($_SESSION);
// var_dump($_REQUEST);
// exit;


// ################################# CSRF CHECK #################################
if (!array_key_exists('HTTP_REFERER', $_SERVER) || str_contains($_SERVER['HTTP_REFERER'], 'http://localhost/todo.php/')) {
        header('Location: todo?php?msg=error_referer');
        exit;
    }

else if (!array_key_exists('token', $_SESSION) || !array_key_exists('token', $_REQUEST) || $_SESSION['token'] !== $_REQUEST['token']) {
            header ('Location: todo.php?msg= error_csrf');
            exit;
    }
// #############################################################################

// ############################# ADD TASK FUNCTION #############################
if (isset($_REQUEST) && $_REQUEST['action'] === 'add') {
$query = $dbCo->prepare("INSERT INTO task (task_creation_date, task_description, task_order, ID_status)
                        VALUES (NOW(), :description, 1, 1)");

$isOk = $query->execute([
    'description' => (strip_tags($_POST['description'])),
]);

header('location: todo.php?msg=' . ($isOk ? "Ok" : "NotOk"));
exit;
}
// ############################################################################


// ########################## MODIFY STATUS FUNCTION ##########################
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
// ###########################################################################


// ################################ EDIT TASK ################################
// if (isset($_REQUEST) && $_REQUEST['action'] === 'edit') {

//     $query3 = $dbCo->prepare("UPDATE task SET task_description = :desc WHERE id_task = :id_task");
    
//     if (isset($_REQUEST['desc'])) {
//         $query3->execute([  'desc' => $_REQUEST['desc'],
//                             'id_task' => $_REQUEST['idt']]);
//         header('Location: todo.php?msg=Ok');
//     } else {
//         header('Location: todo.php?msg=NotOk');
//     }
// exit;
// }
// ###########################################################################


// ############################### DELETE TASK ###############################
if (isset($_REQUEST) && $_REQUEST['action'] === 'delete') {

    $query4 = $dbCo->prepare("DELETE FROM task WHERE id_task = :id_task");
    $query4->execute(['id_task' => $_REQUEST['idt']]);
        
    header('Location: todo.php?msg=Ok');
} else {
    header('Location: todo.php?msg=NotOk');
    exit;
}
// ###########################################################################


// ################################ ORDER BY ################################
// if (isset($_REQUEST) && $_REQUEST['action'] === 'orderby') {

//     $query5 = $dbCo->prepare("  SELECT ID_task, task_creation_date, task_description, ID_status, status_name
//                                 FROM task t
//                                     JOIN status s USING (ID_status)
//                                 ORDER BY :orderby    ");

//     $result5 = $query5->execute(['orderby' => $_REQUEST['orderBySelect']]);
//     $result5 = $query5->fetchAll();
        
//     header('Location: todo.php?msg=Ok');
// } else {
//     header('Location: todo.php?msg=NotOk');
//     exit;
// }

// ###########################################################################
