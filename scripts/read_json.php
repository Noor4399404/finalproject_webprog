<?php
if (isset($_POST['call_now'])) {
    $json_file = file_get_contents("../data/test_sessions.json");

    file_put_contents('./data/test_sessions.json', json_encode($json_file));
}

