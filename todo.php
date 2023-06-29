<?php

$title = "²Do";
include 'require/_html.php';
include 'require/_header.php';
require 'require/_bdd.php';

?>

<body>

    <form action= "add.php" method="post" class="form_container">
        <label for="add_description"><h2 class="form_title">Quelle tâche souhaitez-vous ajouter ?</h2></label>
        <div class="input_container">
        <input class="input_field" type="text" name="description" id="add_description">
        <input class="input_submit" type="submit" name="submit">
        </div>
        <?php
            if (array_key_exists('msgAdd', $_GET)) {
                echo '<p>'. $_GET['msg'] . '</p>';
            }
        ?>
    </form>

    <section class="popup">

    </section>

<?php

    $query = $dbCo->prepare("SELECT task_creation_date, task_description, status_name
                            FROM task t
                                JOIN status s USING (ID_status)
                            ORDER BY task_creation_date DESC");
    $query->execute();
    $result = $query->fetchAll() ;
    // var_dump($result);



echo '<ul class="task">';

foreach ($result as $task) {
    echo '<div class="task_container">';
    // echo '<p class ="task_ttl">' . $task['task_name'] . '</p>';
    echo '<li class="task_box"><input type="checkbox" id="checkBoxDelete"></li>';
    echo '<li class="task_list">'. $task['task_description'] .'</li>';
    echo '<li class="task_list"><button class="task_btn">'. $task['status_name'] .'</button></li>';
    echo '</div>';
}

echo '</ul>';

?>


</body>

<?php

include 'require/_footer.php';
