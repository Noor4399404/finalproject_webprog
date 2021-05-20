<?php
/* Header */
$page_title = 'Webprogramming Final assignment';
$navigation = array(
    'active' => 'Home',
    'items' => array(
        'How To Play' => '/WP21/finalproject_webprog/game_rules.php'
    )
);
include __DIR__ . '/tpl/head.php';
include __DIR__ . '/tpl/body_start.php';
?>




<div id="home-header">
    <h1>Scotland Yard!</h1>

    <div class="game-home-buttons">
        <button class="game-home-button">Host game</button>

        <button class="game-home-button">Join game</button>
    </div>
</div>

<div class="home-div">
    <div class="col-6-flex">
        <p>Do you wanna know how to play the game. Look at our guide to see the rules, some tips and the best way to beat your friends. You can find our guide <a href="./game_rules.php">here</a>. It will also be available during all of the game.</p>
    </div>
    <div class="col-6-flex">
        <p>Playing games is more fun with friends and this site makes playing the game with friends easy. You can invite friends when hosting the game. When one of your friends already hosted a game, you can join their game by entering the code they are given.</p>
    </div>
</div>










<?php
include __DIR__ . '/tpl/body_end.php';
?>