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
<br><h1>These are the rules!</h1>
    <br><p>Mister X tries to escape his would-be capturers in London by taxi, bus, underground and boat.
        You have to be a particularly clever detective to be able to catch him.</p>

    <p>Mister X tries to stay one step ahead of the detectives and keep them guessing at his whereabouts right up until the end of the game,
        while the detectives try to pick up his trail and track him down. <br> One person will be Mister X. The host can assign this position, to one of the participants of the game.</p>
    <p class="tip"> Tip: To play the role of Mister X you need nerves of steel,
        so it's best if the most experienced player gives it his best shot.</p>
    <p> You start by choosing a color that will represent you online. <br>
    And a start position is randomly given to you.</p>
    <p class="tip"> Tip: The numbers of the stations on the game board
        are arranged from left to right to make it easier to find your starting positions.</p>
    <h3>Transportation</h3><br>
    <p>The bus (turquoise) only drives from stations with a turquoise semi-circle; a bus will take you a little further than the taxi (along the bus line).<br>

        The underground (red) travels along the red line and covers the furthest distances the quickest. However, there are only a few underground stations (stations with a red inner rectangle) on the map.<br>

        A player uses a ticket with the corresponding color and moves his playing piece to the next station. You can move back along the same route on your next turn.<br>

        All playing pieces can only be moved to unoccupied stations. If there are no unoccupied stations for Mister X to travel to, he has lost the game. Mister X also loses if a detective moves to the station where Mister X is located.</p>
<br>
<?php
include __DIR__ . '/tpl/body_end.php';
?>