<?php

$title = "EN COURS";
include 'require/_html.php';
include 'require/_header.php';
require 'require/_bdd.php';

?>

<body>

<?php

$query = $dbCo->prepare("SELECT task_description, task_order, task_creation_date FROM task WHERE task_order = 2 ORDER BY task_creation_date desc");
$query->execute();
$result = $query->fetchAll() ;

foreach ($result as $task) {
    echo '<ul class="task_container">';
    // echo '<p class ="task_ttl">' . $task['task_name'] . '</p>';
    echo '<li class="task_list">'. $task['task_description'] .'</li>';
    echo '</ul>';
}

?>


</body>

<?php

include 'require/_footer.php';