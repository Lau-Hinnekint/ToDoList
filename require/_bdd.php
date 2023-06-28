<?php

try {
    $dbCo = new PDO(
    'mysql:host=localhost;dbname=2do;charset=utf8',
    'User1',
    '123'
    );

    $dbCo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}

catch (Exception $e) {
    die('Unable to connect to the database.'.$e->getMessage());
}

?>