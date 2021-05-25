<?php
session_start();
/* Header */
$page_title = 'Webprogramming Final assignment';
$navigation = array(
    'active' => 'Home',
    'items' => array(
        'How To Play' => '/WP21/finalproject_webprog/game_rules.php',
        'Test_movement' => '/WP21/finalproject_webprog/test_movement.php'
    )
);
include __DIR__ . '/tpl/head.php';
include __DIR__ . '/tpl/body_start.php';

$isHost = $_POST["is-host"];
?>

<script src="./scripts/create_and_join_sessions.js"></script>


<form>
    <input type="hidden" name="isHost" id="isHost" value='<?php echo $_SESSION["isHost"]; ?>'>
    <input type="hidden" name="gameId" id="gameId" value='<?php echo $_SESSION["gameId"]; ?>'>
    <input type="hidden" name="userId" id="userId" value='<?php echo $_SESSION["userId"]; ?>'>
</form>



<?php
include __DIR__ . '/tpl/body_end.php';
?>