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
    <p>Mister X tries to escape his would-be capturers in London by taxi, bus, underground and boat. You have to be a particularly clever detective to be able to catch him.</p>

    <p>Mister X tries to stay one step ahead of the detectives and keep them guessing at his whereabouts right up until the end of the game, while the detectives try to pick up his trail and track him down.</p>
    <p class="tip"> Tip: To play the role of Mister X you need nerves of steel, so it's best if the most experienced player gives it his best shot.</p>
 <?php
include __DIR__ . '/tpl/body_end.php';
?>