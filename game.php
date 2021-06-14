<?php
/* Header */
$page_title = 'Webprogramming Final assignment';
$navigation = array(
    'active' => 'Game',
    'items' => array(
        'Home' => './index.php',
        'Game' => './game.php',
        'How To Play' => './game_rules.php',
        'Test_movement' => './test_movement.php'
    )
);
include __DIR__ . '/tpl/head.php';
include __DIR__ . '/tpl/body_start.php';


$json_file = file_get_contents("data/trigger_locations.json");

?>

<!-- Modal -->
<div class="modal fade" id="ruleModal" tabindex="-1" role="dialog" aria-labelledby="ruleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="ruleModalLongTitle">Game Rules!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="instructions">
                    <br>
                    <h2>These are the rules!</h2><br>

                    <p>In the center of london it is not difficult to hide in the traffic. If anyone wants to make himself untraceable here, it takes the best detectives of Scotland Yard to perhaps still track him down. <br>One of the players is 'Mister X', who is hiding somewhere on his flight across London. He moves "invisibly" and only shows himself after covering a certain amount of cards. All the other players are Scotland Yard's detectives and try to track him down. </p>

                    <p>Mister X tries to escape his would-be capturers in London by taxi, bus, underground and boat.
                        You have to be a particularly clever detective to be able to catch him.</p>

                    <p>Mister X tries to stay one step ahead of the detectives and keep them guessing at his whereabouts right up until the end of the game,
                        while the detectives try to pick up his trail and track him down. <br> One person will be Mister X. The host can assign this position, to one of the participants of the game.</p>

                    <h3>Goal of the game</h3><br>
                    <p>If a detective manages to get to the same place as the invisible "Mister X" , then "Mister X" must show himself and the detectives win. However, if "Mister X" manages to remain undetected until the detectives have used all their tickets and thus all their moves, "Mister X" has won.
                        <br> A start position is randomly given to you.</> <br>

                    <h3>Preparation</h3><br>
                    <p>Each detective receives:
                    <ul>
                        <li>10 taxi tickets</li>
                        <li>8 bus tickets</li>
                        <li>4 underground tickets</li>
                    </ul>
                    Mister X receives:
                    <ul>
                        <li>as many black tickets as detectives participate in the game</li>
                        <li>4 taxi tickets</li>
                        <li>3 bus tickets</li>
                        <li>3 underground tickets</li>
                        <li>2 double tickets</li>
                    </ul>
                    </p>

                    Every time a detective uses a ticket, this ticket is given to Mister X.

                    <p class="tip"> Tip: To play the role of Mister X you need nerves of steel,
                        so it's best if the most experienced player gives it his best shot.</p>



                    <Br>
                    <h3>Transportation</h3><br>
                    <p>Every move is a ride on the bus, the underground or the famous london taxi. For such a ride, a matching ticket must be handed to Mister X. The traffic lines drawn on the game board correspond in color to the tickets. Each point is a stop for one or more means of transport. The colors of the stops indicate which means of transport may stop there.</p>

                    <p class="tip"> Tip: The numbers of the stations on the game board
                        are arranged from left to right to make it easier to find your starting positions.</p><br>
                    <div class="one_piece">
                        <figure>
                            <img src="images/taxi_station.jpg" alt="A station on the Scotland Yard game board." title="Scotland Yard Station" width="175" height="200" />
                            <figcaption><i>Station 1</i></figcaption>
                        </figure>
                    </div>
                    <div class="one_piece">
                        <figure>
                            <img src="images/bus_station.jpg" alt="A station on the Scotland Yard game board." title="Scotland Yard Station" width="175" height="200" />
                            <figcaption><i>Station 2</i></figcaption>
                        </figure>
                    </div>
                    <div class="one_piece">
                        <figure>
                            <img src="images/one_piece.jpg" alt="A station on the Scotland Yard game board." title="Scotland Yard Station" width="175" height="200" />
                            <figcaption><i>Station 3</i></figcaption>
                        </figure>
                    </div>
                    <p>Every station is a taxi station (<i>station 1</i>). The bus only drives from stations with a turquoise semi-circle (<i>station 2</i>). A bus will take you a little further than the taxi (along the bus line).<br>

                        The underground travels along the red line and covers the furthest distances the quickest. However, there are only a few underground stations (<i>station 3</i>) on the map.<br>

                        A player uses a ticket with the corresponding color and moves his playing piece to the next station. You can move back along the same route on your next turn.<br>

                        All playing pieces can only be moved to unoccupied stations. If there are no unoccupied stations for Mister X to travel to, he has lost the game. Mister X also loses if a detective moves to the station where Mister X is located.
                        When a player is standing on a 'number' all possible moves light up.</p><br>
                    <div class="d-flex flex-row justify-content-around">
                        <button class="vehicle_buttons btn-warning">
                            <div class=" vehicle_info_div">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5H15V3H9v2H6.5c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z" />
                                    <circle cx="7.5" cy="14.5" r="1.5" />
                                    <circle cx="16.5" cy="14.5" r="1.5" />
                                </svg>
                                <p>10</p>
                            </div>
                        </button>
                        <button class="vehicle_buttons btn-info">
                            <div class=" vehicle_btton_div vehicle_info_div">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2c-4.42 0-8 .5-8 4v10c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4zm5.66 2.99H6.34C6.89 4.46 8.31 4 12 4s5.11.46 5.66.99zm.34 2V10H6V6.99h12zm-.34 9.74l-.29.27H6.63l-.29-.27C6.21 16.62 6 16.37 6 16v-4h12v4c0 .37-.21.62-.34.73z" />
                                    <circle cx="8.5" cy="14.5" r="1.5" />
                                    <circle cx="15.5" cy="14.5" r="1.5" />
                                </svg>
                                <p>8</p>
                            </div>
                        </button>
                        <button class="vehicle_buttons btn-danger">
                            <div class="  vehicle_info_div">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M17.8 2.8C16 2.09 13.86 2 12 2s-4 .09-5.8.8C3.53 3.84 2 6.05 2 8.86V22h20V8.86c0-2.81-1.53-5.02-4.2-6.06zM9.17 20l1.5-1.5h2.66l1.5 1.5H9.17zm-2.16-6V9h10v5h-10zm9.49 2c0 .55-.45 1-1 1s-1-.45-1-1 .45-1 1-1 1 .45 1 1zm-8-1c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM20 20h-3.5v-.38l-1.15-1.16c1.49-.17 2.65-1.42 2.65-2.96V9c0-2.63-3-3-6-3s-6 .37-6 3v6.5c0 1.54 1.16 2.79 2.65 2.96L7.5 19.62V20H4V8.86c0-2 1.01-3.45 2.93-4.2C8.41 4.08 10.32 4 12 4s3.59.08 5.07.66c1.92.75 2.93 2.2 2.93 4.2V20z" />
                                </svg>
                                <p>4</p>
                            </div>
                        </button>
                    </div>
                    <p><span class="transport_explained">Taxi button</span> <span class="transport_explained">Bus button</span> <span class="transport_explained">Underground button</span></p>
                    <br>
                    <p>With these buttons it is possible to move on te board. You cannot always use every button. It depends on which station you are positioned. And be aware of how many buttons you have left. You do not have infinite buttons. </p>

                    <div class="misterX">
                        </b>
                        <h3> Mister X</h3><br>
                        <p>Mister X always makes the first move. This is not visible to the detectives. The means of transport is visible to the detectives.
                            Mister X has a special move:<br>
                            <Br><b>Appearing</b>, The location of "Mister X" is shown regularly: the third, eighth, thirteenth, eighteenth and the last move.<br></p>
                    </div>
                    <br>
                    <p><b>Good Luck!</b></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php

?>

<div class="d-flex flex-column" id="game-main-element">
    <header id="game-header" class="d-flex flex-row p-2 align-items-center">
        <div class="col-md-6 d-flex justify-content-between">
            <div class="border-light mx-1 border vehicle_info_div">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z" />
                </svg>
                <p id="reveal-number-info" class="mb-0" style="font-weight: 300;">3 rounds</p>
            </div>
            <div class="border-light mx-1 border vehicle_info_div">
                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                    <g>
                        <rect fill="none" height="24" width="24" />
                    </g>
                    <g>
                        <path d="M20,10V8h-4V4h-2v4h-4V4H8v4H4v2h4v4H4v2h4v4h2v-4h4v4h2v-4h4v-2h-4v-4H20z M14,14h-4v-4h4V14z" />
                    </g>
                </svg>
                <p id="round-number-info" class="mb-0" style="font-weight: 300;">round 1</p>
            </div>
            <div class="border-light mx-1 border vehicle_info_div">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm6-1.8C18 6.57 15.35 4 12 4s-6 2.57-6 6.2c0 2.34 1.95 5.44 6 9.14 4.05-3.7 6-6.8 6-9.14zM12 2c4.2 0 8 3.22 8 8.2 0 3.32-2.67 7.25-8 11.8-5.33-4.55-8-8.48-8-11.8C4 5.22 7.8 2 12 2z" />
                </svg>
                <span id="station">X station</span>
            </div>
        </div>

        <div class="ml-auto">
            <button id="hide-icons-button" class="btn btn-secondary rounded">Hide user icons</button>
            <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#ruleModal" value="?">
            <input type="button" class="btn btn-danger" id="end-game-button" value="End Game">
        </div>
    </header>
    <div class="d-flex" id="gamebody">
        <div class="d-flex col-md-8 canvas-div" id="canvas-div">
            <div class="mx-auto">
                <script type="text/javascript" src="scripts/game_mechanics.js"></script>
                <canvas id="gameCanvas">Your browser does not support the game, try updating it or using another one, like Chrome</canvas>
            </div>
        </div>
        <div id="game-information" class="py-0 d-flex flex-column justify-content-around px-2 my-0">
            <div class="px-2" style="overflow-x: scroll;">
                <table class="table" id="moves_table">
                    <thead>
                        <tr>
                            <th scope="col">
                                Vehicle
                            </th>
                            <th scope="col">
                                <div class="border-warning border vehicle_info_div">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5H15V3H9v2H6.5c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z" />
                                        <circle cx="7.5" cy="14.5" r="1.5" />
                                        <circle cx="16.5" cy="14.5" r="1.5" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col">
                                <div class="border-info border vehicle_info_div">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M12 2c-4.42 0-8 .5-8 4v10c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4zm5.66 2.99H6.34C6.89 4.46 8.31 4 12 4s5.11.46 5.66.99zm.34 2V10H6V6.99h12zm-.34 9.74l-.29.27H6.63l-.29-.27C6.21 16.62 6 16.37 6 16v-4h12v4c0 .37-.21.62-.34.73z" />
                                        <circle cx="8.5" cy="14.5" r="1.5" />
                                        <circle cx="15.5" cy="14.5" r="1.5" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col">
                                <div class="border-danger border vehicle_info_div">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M17.8 2.8C16 2.09 13.86 2 12 2s-4 .09-5.8.8C3.53 3.84 2 6.05 2 8.86V22h20V8.86c0-2.81-1.53-5.02-4.2-6.06zM9.17 20l1.5-1.5h2.66l1.5 1.5H9.17zm-2.16-6V9h10v5h-10zm9.49 2c0 .55-.45 1-1 1s-1-.45-1-1 .45-1 1-1 1 .45 1 1zm-8-1c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM20 20h-3.5v-.38l-1.15-1.16c1.49-.17 2.65-1.42 2.65-2.96V9c0-2.63-3-3-6-3s-6 .37-6 3v6.5c0 1.54 1.16 2.79 2.65 2.96L7.5 19.62V20H4V8.86c0-2 1.01-3.45 2.93-4.2C8.41 4.08 10.32 4 12 4s3.59.08 5.07.66c1.92.75 2.93 2.2 2.93 4.2V20z" />
                                    </svg>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="d-flex flex-column">
                <div style="overflow-y: scroll; height: 150px;">
                    <table class="table" id="mrxtable">
                        <thead>
                            <th scope="col">
                                Round
                            </th>
                            <th scope="col">
                                Vehicle Mr. X
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    1
                                </th>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    2
                                </th>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    3
                                </th>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    4
                                </th>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    5
                                </th>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    6
                                </th>
                                <td>

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
            <div>
                <div id="make-move-div" class="p-2 flex-column" style="display: flex;">
                    <h4 class="text-center">Make move</h4>
                    <div class="d-flex flex-row justify-content-around">
                        <button class="vehicle_buttons btn-warning" id="move_buttons">
                            <div class="vehicle_button_div vehicle_info_div" id="tax_button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5H15V3H9v2H6.5c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z" />
                                    <circle cx="7.5" cy="14.5" r="1.5" />
                                    <circle cx="16.5" cy="14.5" r="1.5" />
                                </svg>
                                <p>24</p>
                            </div>
                        </button>
                        <button class="vehicle_buttons btn-info" id="move_buttons">
                            <div class="vehicle_button_div vehicle_info_div" id="bus_button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M12 2c-4.42 0-8 .5-8 4v10c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4zm5.66 2.99H6.34C6.89 4.46 8.31 4 12 4s5.11.46 5.66.99zm.34 2V10H6V6.99h12zm-.34 9.74l-.29.27H6.63l-.29-.27C6.21 16.62 6 16.37 6 16v-4h12v4c0 .37-.21.62-.34.73z" />
                                    <circle cx="8.5" cy="14.5" r="1.5" />
                                    <circle cx="15.5" cy="14.5" r="1.5" />
                                </svg>
                                <p>24</p>
                            </div>
                        </button>
                        <button class="vehicle_buttons btn-danger" id="move_buttons">
                            <div class="vehicle_button_div vehicle_info_div" id="und_button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                    <path d="M17.8 2.8C16 2.09 13.86 2 12 2s-4 .09-5.8.8C3.53 3.84 2 6.05 2 8.86V22h20V8.86c0-2.81-1.53-5.02-4.2-6.06zM9.17 20l1.5-1.5h2.66l1.5 1.5H9.17zm-2.16-6V9h10v5h-10zm9.49 2c0 .55-.45 1-1 1s-1-.45-1-1 .45-1 1-1 1 .45 1 1zm-8-1c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM20 20h-3.5v-.38l-1.15-1.16c1.49-.17 2.65-1.42 2.65-2.96V9c0-2.63-3-3-6-3s-6 .37-6 3v6.5c0 1.54 1.16 2.79 2.65 2.96L7.5 19.62V20H4V8.86c0-2 1.01-3.45 2.93-4.2C8.41 4.08 10.32 4 12 4s3.59.08 5.07.66c1.92.75 2.93 2.2 2.93 4.2V20z" />
                                </svg>
                                <p>24</p>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</div>




<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>

</html>