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

echo "{$_SESSION["gameId"]}<br>";
echo $_SESSION["userId"];

?>  

<?php
include __DIR__ . '/tpl/body_end.php';
?>