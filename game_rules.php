<?php
/* Header */
$page_title = 'Webprogramming Final assignment';
$navigation = Array(
    'active' => 'How To Play',
    'items' => Array(
        'Home' => '/WP21/finalproject_webprog/index.php',
        'How To Play' => '/WP21/finalproject_webprog/game_rules.php',
        'Test_movement' => '/WP21/finalproject_webprog/test_movement.php'
        )
    );
include __DIR__ . '/tpl/head.php';
include __DIR__ . '/tpl/body_start.php';
?>
<h1>These are the rules!</h1>
<?php
include __DIR__ . '/tpl/body_end.php';
?>