<?php
session_start();
/* Header */
$page_title = 'Webprogramming Final assignment';
$navigation = Array(
    'active' => 'Home',
    'items' => Array(
        'Home' => '/WP21/finalproject_webprog/index.php',
        'Game' => '/WP21/finalproject_webprog/game.php',
        'How To Play' => '/WP21/finalproject_webprog/game_rules.php',
        'Test_movement' => '/WP21/finalproject_webprog/test_movement.php'
    )
);
include __DIR__ . '/tpl/head.php';
include __DIR__ . '/tpl/body_start.php';
?>
<script src="./scripts/create_and_join_sessions.js"></script>



<div id="home-header">
    <h1>Scotland Yard</h1>

    <div class="game-home-buttons">
        <form action="./join_game_test.php" method="POST">

            <input id="host-game-code-input" type="hidden" value="" name="host-game-id">
            <button type="submit" id="start-game-button" class="game-home-button">Host game</button>

            <input id="join-game-code-input" class="form-control join-game-text-input-home d-none" placeholder="#game id" type="text" value="" name="join-game-id">
            <button type="submit" id="join-game-button" class="enter-game-id-button game-home-button">Join game</button>
        </form>

    </div>
</div>

<div class="container">
    <div class="row wp-row">
        <div class="col-md-6">
            <p>Do you wanna know how to play the game. Look at our guide to see the rules, some tips and the best way to beat your friends. You can find our guide <a href="./game_rules.php">here</a>. It will also be available during all of the game.</p>
        </div>
        <div class="col-md-6">
            <p>Playing games is more fun with friends and this site makes playing the game with friends easy. You can invite friends when hosting the game. When one of your friends already hosted a game, you can join their game by entering the code they are given.</p>
        </div>
    </div>
</div>



<?php
include __DIR__ . '/tpl/body_end.php';
?>