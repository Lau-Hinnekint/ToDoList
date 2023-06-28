<?php
require 'includes/_bdd.php';
$query = $dbCo->prepare(" INSERT TO 'task'('task_description', 'task_name', 'task_creation_date')
                            VALUES ( ,  ,  )");
$isOk = $query->execute([
    'task'
]);

?>