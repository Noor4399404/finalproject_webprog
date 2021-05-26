<?php
/* Header */
$page_title = 'Webprogramming Final assignment';
$navigation = Array(
    'active' => 'Game',
    'items' => Array(
        'Home' => '/WP21/finalproject_webprog/index.php',
        'Game' => '',
        'How To Play' => '/WP21/finalproject_webprog/game_rules.php',
        'Test_movement' => '/WP21/finalproject_webprog/test_movement.php'
        )
    );
include __DIR__ . '/tpl/head.php';

$json_file = file_get_contents("data/trigger_locations.json");

?>
<div class="container-fluid">

    <script type="text/javascript" src="scripts/game_mechanics.js"></script>
    <canvas id="gameCanvas">Your browser does not support the game, try updating it or using another one, like Chrome</canvas>
<?php
include __DIR__ . '/tpl/body_end.php';
?>