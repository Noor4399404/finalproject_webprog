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
<div class="row">
    <div class="col">
        <h5>Select your active button:</h5>
        <form action="test_movement.php" method="POST">
            <div class="col">
                <input type="submit" name="submit" class="btn btn-primary" id="numberOne" value="1">
            </div>
            <div class="col">
                <input type="submit" name="submit" class="btn btn-primary" id="numberTwo" value="2">
            </div>
            <div class="col">
                <input type="submit" name="submit" class="btn btn-primary" id="numberThree" value="3">
            </div>
            <div class="col">
                <input type="submit" name="submit" class="btn btn-primary" id="numberFour" value="4">
            </div>
            <div class="col">
                <input type="submit" name="submit" class="btn btn-primary" id="numberFive" value="5">
            </div>
            <div class="col">
                <input type="submit" name="submit" class="btn btn-primary" id="numberSix" value="6">
            </div>
            <div class="col">
                <input type="submit" name="submit" class="btn btn-primary" id="numberSeven" value="7">
            </div>
            <div class="col">
                <input type="submit" name="submit" class="btn btn-primary" id="numberEight" value="8">
            </div>
            <div class="col">
                <input type="submit" name="submit" class="btn btn-primary" id="numberNine" value="9">
            </div>
            <div class="col">
                <input type="submit" name="submit" class="btn btn-primary" id="numberTen" value="10">
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
                    <?php
                    if (isset($_POST['submit'])) {

                    $json_file = file_get_contents("data/possible_moves.json");
                    $buttons = json_decode($json_file, true);

                    $active_button = $_POST['submit'];
                    foreach ($buttons as $key => $value){
                        if ($active_button == $key) {
                            $taxi_value = $value["tax"];
                            $bus_value = $value["bus"];
                            if ($bus_value == " ") {
                                $bus_value = "No Moves!";
                            }
                            $und_value = $value["und"];
                            if ($und_value == " ") {
                                $und_value = "No Moves!";
                            }
                            echo "<td>$taxi_value</td>";
                            echo "<td>$bus_value</td>";
                            echo "<td>$und_value</td>";
                            }
                        }
                    }?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
include __DIR__ . '/tpl/body_end.php';
?>