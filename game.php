<?php
/* Header */
$page_title = 'Webprogramming Final assignment';
$navigation = array(
    'active' => 'Game',
    'items' => array(
        'Home' => '/WP21/finalproject_webprog/index.php',
        'Game' => '/WP21/finalproject_webprog/game.php',
        'How To Play' => '/WP21/finalproject_webprog/game_rules.php',
        'Test_movement' => '/WP21/finalproject_webprog/test_movement.php'
    )
);
include __DIR__ . '/tpl/head.php';

$json_file = file_get_contents("data/trigger_locations.json");

?>

<div class="d-flex" id="gamebody">
    <div class="d-flex col-md-8 p-0 canvas-div" id="canvas-div">
        <script type="text/javascript" src="scripts/game_mechanics.js"></script>
        <canvas id="gameCanvas">Your browser does not support the game, try updating it or using another one, like Chrome</canvas>
    </div>
    <div id="game-information" class="p-0 d-flex flex-column justify-content-around">
        <div class="d-flex flex-row align-items-center">
            <p class="p-2">Rounds player: 24</p>
            <div class="ml-auto p-2">
                <input type="button" class="btn btn-primary" value="?">
                <input type="button" class="btn btn-danger" value="End Game">
            </div>
        </div>
        <div class="px-2">
            <table class="table" id="moves_table">
                <thead>
                    <tr>
                        <th scope="col">
                            Vehicle
                        </th>
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
                            <div class="border-warning border vehicle_info_div">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5H15V3H9v2H6.5c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z" />
                                    <circle cx="7.5" cy="14.5" r="1.5" />
                                    <circle cx="16.5" cy="14.5" r="1.5" />
                                </svg>
                            </div>
                        </td>
                        <td>
                            <p>24</p>
                        </td>
                        <td>
                            <p>24</p>

                        </td>
                        <td>
                            <p>24</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="border-info border vehicle_info_div">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2c-4.42 0-8 .5-8 4v10c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4zm5.66 2.99H6.34C6.89 4.46 8.31 4 12 4s5.11.46 5.66.99zm.34 2V10H6V6.99h12zm-.34 9.74l-.29.27H6.63l-.29-.27C6.21 16.62 6 16.37 6 16v-4h12v4c0 .37-.21.62-.34.73z" />
                                    <circle cx="8.5" cy="14.5" r="1.5" />
                                    <circle cx="15.5" cy="14.5" r="1.5" />
                                </svg>
                            </div>
                        </td>
                        <td>
                            <p>24</p>
                        </td>
                        <td>
                            <p>24</p>

                        </td>
                        <td>
                            <p>24</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="border-danger border vehicle_info_div">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M17.8 2.8C16 2.09 13.86 2 12 2s-4 .09-5.8.8C3.53 3.84 2 6.05 2 8.86V22h20V8.86c0-2.81-1.53-5.02-4.2-6.06zM9.17 20l1.5-1.5h2.66l1.5 1.5H9.17zm-2.16-6V9h10v5h-10zm9.49 2c0 .55-.45 1-1 1s-1-.45-1-1 .45-1 1-1 1 .45 1 1zm-8-1c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM20 20h-3.5v-.38l-1.15-1.16c1.49-.17 2.65-1.42 2.65-2.96V9c0-2.63-3-3-6-3s-6 .37-6 3v6.5c0 1.54 1.16 2.79 2.65 2.96L7.5 19.62V20H4V8.86c0-2 1.01-3.45 2.93-4.2C8.41 4.08 10.32 4 12 4s3.59.08 5.07.66c1.92.75 2.93 2.2 2.93 4.2V20z" />
                                </svg>
                            </div>
                        </td>
                        <td>
                            <p>24</p>
                        </td>
                        <td>
                            <p>24</p>

                        </td>
                        <td>
                            <p>24</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex flex-row">
            <div class="col-md-6 px-2">
                <h5>Mr. X used vehicles</h5>
                <div style="overflow-y: scroll; height: 150px;">
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
                                <td>
                                    <div class="border-warning border vehicle_info_div">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5H15V3H9v2H6.5c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z" />
                                            <circle cx="7.5" cy="14.5" r="1.5" />
                                            <circle cx="16.5" cy="14.5" r="1.5" />
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    2
                                </th>
                                <td>
                                    <div class="border-info border vehicle_info_div">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                            <path d="M12 2c-4.42 0-8 .5-8 4v10c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4zm5.66 2.99H6.34C6.89 4.46 8.31 4 12 4s5.11.46 5.66.99zm.34 2V10H6V6.99h12zm-.34 9.74l-.29.27H6.63l-.29-.27C6.21 16.62 6 16.37 6 16v-4h12v4c0 .37-.21.62-.34.73z" />
                                            <circle cx="8.5" cy="14.5" r="1.5" />
                                            <circle cx="15.5" cy="14.5" r="1.5" />
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    3
                                </th>
                                <td>
                                    <div class="border-info border vehicle_info_div">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                            <path d="M12 2c-4.42 0-8 .5-8 4v10c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4zm5.66 2.99H6.34C6.89 4.46 8.31 4 12 4s5.11.46 5.66.99zm.34 2V10H6V6.99h12zm-.34 9.74l-.29.27H6.63l-.29-.27C6.21 16.62 6 16.37 6 16v-4h12v4c0 .37-.21.62-.34.73z" />
                                            <circle cx="8.5" cy="14.5" r="1.5" />
                                            <circle cx="15.5" cy="14.5" r="1.5" />
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    4
                                </th>
                                <td>
                                    <div class="border-danger border vehicle_info_div">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                            <path d="M17.8 2.8C16 2.09 13.86 2 12 2s-4 .09-5.8.8C3.53 3.84 2 6.05 2 8.86V22h20V8.86c0-2.81-1.53-5.02-4.2-6.06zM9.17 20l1.5-1.5h2.66l1.5 1.5H9.17zm-2.16-6V9h10v5h-10zm9.49 2c0 .55-.45 1-1 1s-1-.45-1-1 .45-1 1-1 1 .45 1 1zm-8-1c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM20 20h-3.5v-.38l-1.15-1.16c1.49-.17 2.65-1.42 2.65-2.96V9c0-2.63-3-3-6-3s-6 .37-6 3v6.5c0 1.54 1.16 2.79 2.65 2.96L7.5 19.62V20H4V8.86c0-2 1.01-3.45 2.93-4.2C8.41 4.08 10.32 4 12 4s3.59.08 5.07.66c1.92.75 2.93 2.2 2.93 4.2V20z" />
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    5
                                </th>
                                <td>
                                    <div class="border-warning border vehicle_info_div">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5H15V3H9v2H6.5c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z" />
                                            <circle cx="7.5" cy="14.5" r="1.5" />
                                            <circle cx="16.5" cy="14.5" r="1.5" />
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    6
                                </th>
                                <td>
                                    <div class="border-warning border vehicle_info_div">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                            <path d="M0 0h24v24H0V0z" fill="none" />
                                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5H15V3H9v2H6.5c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z" />
                                            <circle cx="7.5" cy="14.5" r="1.5" />
                                            <circle cx="16.5" cy="14.5" r="1.5" />
                                        </svg>
                                    </div>
                                </td>
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
            <div class="col-md-6 px-2 d-flex flex-column" style="align-items: center;">
                <div>
                    <h6 class="text-center">
                        X more moves until Mr. X reveals himself!
                    </h6>
                </div>
            </div>
        </div>
        <div class="p-2 d-flex flex-column">
            <h4 class="text-center">Make move</h4>
            <div class="d-flex flex-row justify-content-around">
                <button class="vehicle_buttons btn-warning">
                    <div class="vehicle_button_div vehicle_info_div">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5H15V3H9v2H6.5c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z" />
                            <circle cx="7.5" cy="14.5" r="1.5" />
                            <circle cx="16.5" cy="14.5" r="1.5" />
                        </svg>
                        <p>24</p>
                    </div>
                </button>
                <button class="vehicle_buttons btn-info">
                    <div class=" vehicle_button_div vehicle_info_div">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 2c-4.42 0-8 .5-8 4v10c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4zm5.66 2.99H6.34C6.89 4.46 8.31 4 12 4s5.11.46 5.66.99zm.34 2V10H6V6.99h12zm-.34 9.74l-.29.27H6.63l-.29-.27C6.21 16.62 6 16.37 6 16v-4h12v4c0 .37-.21.62-.34.73z" />
                            <circle cx="8.5" cy="14.5" r="1.5" />
                            <circle cx="15.5" cy="14.5" r="1.5" />
                        </svg>
                        <p>24</p>
                    </div>
                </button>
                <button class="vehicle_buttons btn-danger">
                    <div class=" vehicle_button_div vehicle_info_div">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M17.8 2.8C16 2.09 13.86 2 12 2s-4 .09-5.8.8C3.53 3.84 2 6.05 2 8.86V22h20V8.86c0-2.81-1.53-5.02-4.2-6.06zM9.17 20l1.5-1.5h2.66l1.5 1.5H9.17zm-2.16-6V9h10v5h-10zm9.49 2c0 .55-.45 1-1 1s-1-.45-1-1 .45-1 1-1 1 .45 1 1zm-8-1c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM20 20h-3.5v-.38l-1.15-1.16c1.49-.17 2.65-1.42 2.65-2.96V9c0-2.63-3-3-6-3s-6 .37-6 3v6.5c0 1.54 1.16 2.79 2.65 2.96L7.5 19.62V20H4V8.86c0-2 1.01-3.45 2.93-4.2C8.41 4.08 10.32 4 12 4s3.59.08 5.07.66c1.92.75 2.93 2.2 2.93 4.2V20z" />
                        </svg>
                        <p>24</p>
                    </div>
                </button>
            </div>
            <div class="my-3">
                <button type="button" style="width: 100%;" class="btn btn-success">Submit Move</button>
            </div>
        </div>
    </div>
</div>