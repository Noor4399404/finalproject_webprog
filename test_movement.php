<?php
/* Header */
$page_title = 'Webprogramming Final assignment';
$navigation = Array(
    'active' => 'Test_movement',
    'items' => Array(
        'Home' => '/WP21/finalproject_webprog/index.php',
        'Game' => '/WP21/finalproject_webprog/game.php',
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
<div class="row">
    <div class="col">
        <h5>Select your active button:</h5>
        <form id="testform">
            <div class="col btn btn-primary" id="1">
                1
            </div>
            <div class="col btn btn-primary" id="2">
                2
            </div>
            <div class="col btn btn-primary" id="3">
                3
            </div>
            <div class="col btn btn-primary" id="4">
                4
            </div>
            <div class="col btn btn-primary" id="5">
                5
            </div>
            <div class="col btn btn-primary" id="6">
                6
            </div>
            <div class="col btn btn-primary" id="7">
                7
            </div>
            <div class="col btn btn-primary" id="8">
                8
            </div>
            <div class="col btn btn-primary" id="9">
                9
            </div>
            <div class="col btn btn-primary" id="10">
                10
            </div>
            <div class="col btn btn-primary" id="13">
                13
            </div>
            <div class="col btn btn-primary" id="26">
                26
            </div>
            <div class="col btn btn-primary" id="29">
                29
            </div>
            <div class="col btn btn-primary" id="34">
                34
            </div>
            <div class="col btn btn-primary" id="50">
                50
            </div>
            <div class="col btn btn-primary" id="53">
                53
            </div>
            <div class="col btn btn-primary" id="94">
                94
            </div>
        </form>
    </div>
    <div class="col" id="movement_table">
        <h5>Possible Moves:</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        Taxi
                    </th>
                    <th scope="col">
                        Bus
                    </th>
                    <th scope="col">
                        Underground
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
include __DIR__ . '/tpl/body_end.php';
?>