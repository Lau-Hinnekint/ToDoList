<footer>

    <form action= "add.php" method="post" class="form">
        <label for="add_description"> Description </label>
        <input class="form_input" type="text" name="description" id="add_description">
        <input class="form_submit" type="submit" name="submit"><br>
        <?php
            if (array_key_exists('msg', $_GET)) {
                echo '<p>'. $_GET['msg'] . '</p>';
            }
        ?>
    </form>

</footer>

<script src="js/script.js"></script>

</html>