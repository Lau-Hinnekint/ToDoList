<?php

$title = "²Do";
include 'require/_html.php';
include 'require/_header.php';
require 'require/_bdd.php';

session_start();
$_SESSION['token'] = md5(uniqid(mt_rand(), true));
// var_dump($_SESSION);
?>

<body>
    <!-- ################################### ADD TASK ######################################## -->
    <form action="action.php" method="post" class="form_container">
        <label for="add_description">
            <h2 class="form_title">Quelle tâche souhaitez-vous ajouter ?</h2>
        </label>
        <div class="input_container">
            <input class="input_field" type="text" name="description" id="add_description">
            <input class="input_submit" type="submit" name="submit">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
        </div>
        <?php
        if (array_key_exists('msg', $_GET)) {
            $message = $_GET['msg'];
            if ($message == "Ok") {
                echo "<section class='popin_Success_Add'>
                            <div class='popin_Success_Add_box'>
                                <a class='closePopIn'>&times;</a>
                                <p class='popin_Success_Add_text'> L'action a été effectué avec succès! <p>
                            </div>
                        </section>";
            } else if ($message == 'NotOk') {
                echo "<section class='popin_Fail_Add'>
                        <div class='popin_Fail_Add_box'>
                            <a class='closePopIn'>&times;</a>
                            <p class='popin_Fail_Add_text'> Une erreur est survenu, l'action n'a pas été effectué ! <p>
                        </div>
                    </section>";
            }
        }
        ?>
    </form>
    <!-- ##################################################################################### -->


    <!-- ################################### ORDER BY ######################################## -->
    <form class="orderby_container" method="post" action="action.php" id="orderBy">
        <label class="orderby_ttl" for="orderBy">Trier par : </label>
        <select class="orderBySelect" name="orderBySelect" id="orderBy">
            <option class="orderby_txt" value="" selected></option>
            <option class="orderby_txt" value="ID_status">Status</option>
            <option class="orderby_txt" value="task_creation_date">Date de création</option>
        </select>
        <input class="orderby_submit" type="submit" value="Ok" name="requete">
    </form>
    <!-- ##################################################################################### -->
    
    
    <!-- ################################### CREATE TASK LIST ######################################## -->
    <?php
        $query = $dbCo->prepare("SELECT ID_task, task_creation_date, task_description, ID_status, status_name
                                FROM task t
                                    JOIN status s USING (ID_status)
                                    WHERE ID_status = 1
                                ORDER BY task_creation_date DESC");
        $query->execute();
        $result = $query->fetchAll();
    
    echo '<ul class="task">';
    
        foreach ($result as $task) {
            echo '<div class="task_container">';
            // echo '<p class ="task_ttl">' . $task['task_name'] . '</p>';
            // echo '<li class="task_box"><input type="checkbox" id="checkBoxDelete"></li>';
            echo '<li class="task_list">' . $task['task_description'] . '</li>';
            // ################################### MODIFY STATUS ########################################
            echo '<li class="task_list"><div class="task_status">';
            echo '<a href="action.php?action=modify&idt=' . $task["ID_task"] . '&ids=' . $task["ID_status"] . '"class="task_lnk">' . $task["status_name"] . '</a>';
            echo '</div></li>';
            // ###################################################################################
            
            // ################################### EDIT TASK ########################################        
            echo '  <form action="action.php?idt=' . $task["ID_task"] . '" method="post" class="modify_container">
            <input class="input_field" type="text" name="desc" id="modify_task" placeholder="Modifier le texte ici.">
            <input type="hidden" name="action" value="edit">
            <input class="modify_submit" type="submit">
            </form>';
            // ###################################################################################
            
            // ################################### REMINDER ######################################
            echo '<form action="action.php?idt=' . $task["ID_task"] . '" method="post" class="reminder_container">
            <input class="reminder_select" type="date" id="start" name="trip-start" value="" min="2023-06-01" max="2025-01-01">
            <input class="reminder_submit" type="submit" name="submit" value="Ok">
            </form>';
            // ###################################################################################

            echo '<div class="button_container">';
            echo '<i class="fa-solid fa-pen modify" style="color: #000000;"></i>';
            echo '<i class="fa-solid fa-bell reminder" style="color: #000000;"></i>';

            // ################################### DELETE ########################################
            echo '  <a href="action.php?id=' . $task["ID_task"] . '" class="delete">
            <i class="fa-solid fa-trash delete" style="color: #000000;"></i></a>';
            // ###################################################################################
            echo '</div>';
            echo '</div>';
        }
    
    echo '</ul>';
    ?>
    <!-- ##################################################################################### -->

</body>

<?php

include 'require/_footer.php';
