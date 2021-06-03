<?php
/* Header */
$page_title = 'Webprogramming Final assignment';
$navigation = Array(
    'active' => 'Game',
    'items' => Array(
        'Home' => '/WP21/finalproject_webprog/index.php',
        'Game' => '/WP21/finalproject_webprog/game.php',
        'How To Play' => '/WP21/finalproject_webprog/game_rules.php',
        'Test_movement' => '/WP21/finalproject_webprog/test_movement.php'
        )
    );
include __DIR__ . '/tpl/head.php';

$json_file = file_get_contents("data/trigger_locations.json");

?>
<div class="d-flex p-2">
    <div class="d-flex flex-row">
        <div class="d-flex flex-column">
            <div class="container-fluid">
                <script type="text/javascript" src="scripts/game_mechanics.js"></script>
                <canvas id="gameCanvas">Your browser does not support the game, try updating it or using another one, like Chrome</canvas>
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="d-flex flex-row">
                <div class="d-flex flex-column">
                    <h5>X more moves until Mr. X reveals himself!</h5>
                </div>
            </div>
            <div class="d-flex flex-row">
                <div class="d-flex flex-column">
                    <table class="table" id="moves_table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    User 1
                                </th>
                                <th scope="col">
                                    User 2
                                </th>
                                <th scope="col">
                                    Mr. X
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Taxi: 10<br >
                                    Bus: 8<br >
                                    Underground: 4
                                </td>
                                <td>
                                    Taxi: 10<br >
                                    Bus: 8<br >
                                    Underground: 4
                                </td>
                                <td>
                                    Taxi: 4<br >
                                    Bus: 3<br >
                                    Underground: 3
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-center" id="vehiclebuttons">
                <div class="d-flex flex-column m-3">
                    <input type="button" class="btn btn-warning btn-block" value="Taxi: 10">
                </div>
                <div class="d-flex flex-column m-3">
                    <input type="button" class="btn btn-info btn-block" value="Bus: 8">
                </div>
                <div class="d-flex flex-column m-3">
                    <input type="button" class="btn btn-danger btn-block" value="Underground: 4">
                </div>
            </div>
            <div class="d-flex flex-row justify-content-center">
                <div class="d-flex flex-column m-5 col-12">
                    <input type="submit" class="btn btn-success" value="Submit Move">
                </div>
            </div>
            <div class="d-flex flex-row">
                <div class="d-flex flex-column">
                    <h5>Mr. X used vehicles</h5>
                    <div id="mrxdiv">
                        <table class="table" id="mrxtable">
                            <thead>
                                <th scope="col">
                                    Round
                                </th>
                                <th scope="col">
                                    Vehicle
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        1
                                    </th>
                                    <td>Taxi</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        2
                                    </th>
                                    <td>Bus</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        3
                                    </th>
                                    <td>Bus</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        4
                                    </th>
                                    <td>Underground</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        5
                                    </th>
                                    <td>Taxi</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        6
                                    </th>
                                    <td>Taxi</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        7
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        8
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        9
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        10
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        11
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        12
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        13
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        14
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        15
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        16
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        17
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        18
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        19
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        20
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        21
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        22
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        23
                                    </th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        24
                                    </th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-center">
                        <div class="d-flex flex-column align-self-center">
                            <input type="button" class="btn btn-danger" value="End Game">
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-center">
                        <div class="d-flex flex-column align-self-center">
                            <input type="button" class="btn btn-primary" value="?">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include __DIR__ . '/tpl/body_end.php';
?>