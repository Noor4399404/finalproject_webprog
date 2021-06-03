<?php

if (isset($_POST['call_now'])){

    // Read triggers
    $json_file = file_get_contents("../data/test_sessions.json");

    header('Content-Type: application/json');
    echo $json_file;

}

?>