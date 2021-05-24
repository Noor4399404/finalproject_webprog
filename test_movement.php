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
?>
<script type="application/javascript" src="scripts/test_movement.js"></script>
<?php
include __DIR__ . '/tpl/body_start.php';
?>
<form action="test_movement.php" method="POST">
    <div class="col">
        <button type="submit" name="active" class="btn btn-primary active" id="numberOne">1</button>
        <div class="col">
            <button type="submit" name="submit" class="btn btn-primary" id="numberTwo">2</button>
        </div>
        <div class="col">
            <button type="submit" name="submit" class="btn btn-primary" id="numberThree">3</button>
        </div>
        <div class="col">
            <button type="submit" name="submit" class="btn btn-primary" id="numberFour">4</button>
        </div>
        <div class="col">
            <button type="submit" name="submit" class="btn btn-primary" id="numberFive">5</button>
        </div>
        <div class="col">
            <button type="submit" name="submit" class="btn btn-primary" id="numberSix">6</button>
        </div>
        <div class="col">
            <button type="submit" name="submit" class="btn btn-primary" id="numberSeven">7</button>
        </div>
        <div class="col">
            <button type="submit" name="submit" class="btn btn-primary" id="numberEight">8</button>
        </div>
        <div class="col">
            <button type="submit" name="submit" class="btn btn-primary" id="numberNine">9</button>
        </div>
        <div class="col">
            <button type="submit" name="submit" class="btn btn-primary" id="numberTen">10</button>
        </div>
</form>
<?php
include __DIR__ . '/tpl/body_end.php';
?>