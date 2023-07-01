<?php

$title = "²Do";
include 'require/_html.php';
include 'require/_header.php';
require 'require/_bdd.php';
?>
msg=NotOk
<body>

    <form action="add.php" method="post" class="form_container">
        <label for="add_description">
            <h2 class="form_title">Quelle tâche souhaitez-vous ajouter ?</h2>
        </label>
        <div class="input_container">
            <input class="input_field" type="text" name="description" id="add_description">
            <input class="input_submit" type="submit" name="submit">
        </div>
        <?php
        if (array_key_exists('msg', $_GET)) {
            $message = $_GET['msg'];
            if ($message == "Ok") {
                echo    '<section class="popin_Success_Add">
                            <div class="popin_Success_Add_box">
                                <article class="popin_Success_Add_content">
                                    <p class="closePopInAdd">❌</p>
                                    <p class="popin_Success_Add_text"> Votre tâche a été crée avec succès ! <p>
                                </article>
                            </div>
                        </section>';
            } else if ($message == "NotOk") {
                echo "<section class='popin_Fail_Add'>
                        <div class='popin_Fail_Add_box'>
                            <article class='popin_Fail_Add_content'>
                                <p class='closePopInAdd'>❌</p>
                                <p class='popin_Fail_Add_text'> Une erreur est survenu, votre tâche n'a pas été crée ! <p>
                            </article>
                        </div>
                    </section>";
            }
        }
        ?>

    </form>



    <?php

    $query = $dbCo->prepare("SELECT ID_task, task_creation_date, task_description, status_name
                            FROM task t
                                JOIN status s USING (ID_status)
                            ORDER BY task_creation_date DESC");
    $query->execute();
    $result = $query->fetchAll();

    echo '<ul class="task">';

    foreach ($result as $task) {
        echo '<div class="task_container">';
        // echo '<p class ="task_ttl">' . $task['task_name'] . '</p>';
        // echo '<li class="task_box"><input type="checkbox" id="checkBoxDelete"></li>';
        echo '<li class="task_list">' . $task['task_description'] . '</li>';
        echo '<li class="task_list"><a href="action.php?id=' . $task["ID_task"] . '&s=' . $task["status_name"] . '" class="task_lnk">' . $task['status_name'] . '</a></li>';
        echo '</div>';
        echo '<div class="button_container">';
        echo '<svg class="modify_button" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M343.232 560.32a7.872 7.872 0 0 0-1.408 2.624l-45.056 170.88a29.952 29.952 0 0 0 7.168 28.16 27.52 27.52 0 0 0 27.2 7.424l164.224-46.4 0.512 0.128c1.92 0 3.776-0.512 5.12-2.048l438.848-453.568c13.12-13.44 20.16-31.872 20.16-51.84 0-22.656-9.344-45.312-25.472-62.08l-41.408-42.88a84.736 84.736 0 0 0-60.032-26.624c-19.328 0-37.12 7.488-50.24 20.928L343.936 558.72c-0.448 0.512-0.32 1.088-0.704 1.6z m553.664-337.216l-43.648 45.056-70.656-74.24 43.008-44.416c6.784-7.04 20.032-6.08 27.712 2.048l41.536 42.88c4.288 4.48 6.72 10.432 6.72 16.256a17.728 17.728 0 0 1-4.672 12.416zM421.312 567.488l316.608-327.36 70.656 74.304-316.032 326.656-71.232-73.6m-57.664 132.8l22.912-86.912 60.992 63.04-83.904 23.872m561.024-297.472a31.04 31.04 0 0 0-30.336 31.424v422.912a39.488 39.488 0 0 1-38.848 40.192H163.456a39.68 39.68 0 0 1-38.912-40.192V166.784a39.68 39.68 0 0 1 38.912-40.256h445.696a30.784 30.784 0 0 0 30.272-31.296A30.848 30.848 0 0 0 609.216 64H158.912C106.624 64 64 108.032 64 162.112v699.84C64 916.032 106.56 960 158.912 960h701.12c52.416 0 94.912-44.032 94.912-98.048V433.984a30.976 30.976 0 0 0-30.272-31.168z"  /></svg>';
        echo '<svg class="trash_button" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M800 384C782.08 384 768 398.08 768 416L768 832c0 35.2-28.8 64-64 64l-64 0L640 416C640 398.08 625.92 384 608 384 590.08 384 576 398.08 576 416L576 896 448 896 448 416C448 398.08 433.92 384 416 384 398.08 384 384 398.08 384 416L384 896 320 896c-35.2 0-64-28.8-64-64L256 416C256 398.08 241.92 384 224 384 206.08 384 192 398.08 192 416L192 832c0 70.4 57.6 128 128 128l384 0c70.4 0 128-57.6 128-128L832 416C832 398.08 817.92 384 800 384zM864 256l-704 0C142.08 256 128 270.08 128 288 128 305.92 142.08 320 160 320l704 0C881.92 320 896 305.92 896 288 896 270.08 881.92 256 864 256zM352 192l320 0C689.92 192 704 177.92 704 160 704 142.08 689.92 128 672 128l-320 0C334.08 128 320 142.08 320 160 320 177.92 334.08 192 352 192z"  /></svg>';
        echo '</div>';
    }

    echo '</ul>';

    ?>

</body>

<?php

include 'require/_footer.php';
// echo '<div class="button_container">
// <svg class="modify_button" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M343.232 560.32a7.872 7.872 0 0 0-1.408 2.624l-45.056 170.88a29.952 29.952 0 0 0 7.168 28.16 27.52 27.52 0 0 0 27.2 7.424l164.224-46.4 0.512 0.128c1.92 0 3.776-0.512 5.12-2.048l438.848-453.568c13.12-13.44 20.16-31.872 20.16-51.84 0-22.656-9.344-45.312-25.472-62.08l-41.408-42.88a84.736 84.736 0 0 0-60.032-26.624c-19.328 0-37.12 7.488-50.24 20.928L343.936 558.72c-0.448 0.512-0.32 1.088-0.704 1.6z m553.664-337.216l-43.648 45.056-70.656-74.24 43.008-44.416c6.784-7.04 20.032-6.08 27.712 2.048l41.536 42.88c4.288 4.48 6.72 10.432 6.72 16.256a17.728 17.728 0 0 1-4.672 12.416zM421.312 567.488l316.608-327.36 70.656 74.304-316.032 326.656-71.232-73.6m-57.664 132.8l22.912-86.912 60.992 63.04-83.904 23.872m561.024-297.472a31.04 31.04 0 0 0-30.336 31.424v422.912a39.488 39.488 0 0 1-38.848 40.192H163.456a39.68 39.68 0 0 1-38.912-40.192V166.784a39.68 39.68 0 0 1 38.912-40.256h445.696a30.784 30.784 0 0 0 30.272-31.296A30.848 30.848 0 0 0 609.216 64H158.912C106.624 64 64 108.032 64 162.112v699.84C64 916.032 106.56 960 158.912 960h701.12c52.416 0 94.912-44.032 94.912-98.048V433.984a30.976 30.976 0 0 0-30.272-31.168z"  /></svg>
// <svg class="trash_button" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M800 384C782.08 384 768 398.08 768 416L768 832c0 35.2-28.8 64-64 64l-64 0L640 416C640 398.08 625.92 384 608 384 590.08 384 576 398.08 576 416L576 896 448 896 448 416C448 398.08 433.92 384 416 384 398.08 384 384 398.08 384 416L384 896 320 896c-35.2 0-64-28.8-64-64L256 416C256 398.08 241.92 384 224 384 206.08 384 192 398.08 192 416L192 832c0 70.4 57.6 128 128 128l384 0c70.4 0 128-57.6 128-128L832 416C832 398.08 817.92 384 800 384zM864 256l-704 0C142.08 256 128 270.08 128 288 128 305.92 142.08 320 160 320l704 0C881.92 320 896 305.92 896 288 896 270.08 881.92 256 864 256zM352 192l320 0C689.92 192 704 177.92 704 160 704 142.08 689.92 128 672 128l-320 0C334.08 128 320 142.08 320 160 320 177.92 334.08 192 352 192z"  /></svg>
//     </div>';