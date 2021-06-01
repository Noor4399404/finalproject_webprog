<?php
/* Header */
$page_title = 'Webprogramming Final assignment';
$navigation = Array(
    'active' => 'How To Play',
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
<div class="instructions">
<br><h2>These are the rules!</h2><br>

    <p>In the center of london it is not difficult to hide in the traffic. If anyone wants to make himself untraceable here, it takes the best detectives of Scotland Yars detectives to perhaps still track him down. <br>One of the players is 'Mister X', who is hiding somewhere on his flight across London. He moves "invisibly" and only shows himself after covering a certain amount of cards. All the other players are Scotland Yard's detectives and try to track him down. </p>

    <p>Mister X tries to escape his would-be capturers in London by taxi, bus, underground and boat.
        You have to be a particularly clever detective to be able to catch him.</p>

    <p>Mister X tries to stay one step ahead of the detectives and keep them guessing at his whereabouts right up until the end of the game,
        while the detectives try to pick up his trail and track him down. <br> One person will be Mister X. The host can assign this position, to one of the participants of the game.</p>

    <h3>Goal of the game</h3><br>
    <p>If a detective manages to get to the same place as the invisible "Mister X" , then "Mister X" must show himself and the detectives  win. However, if "Mister X" manages to remain undetected until the detectives have used  all their tickets and thus all their moves, "Mister X" has won.
        <br> A start position is randomly given to you.</> <br>

    <h3>Preparation</h3>
    <p>Each detective receives 10 taxi tickets, 8 bus tickets and 4 underground tickets. Mister X receives as many black tickets as detectives participate in the game and 4 taxi tickets, 3 bus tickets and 3 underground tickets.</p>

    <p class="tip"> Tip: To play the role of Mister X you need nerves of steel,
        so it's best if the most experienced player gives it his best shot.</p>



    <h3>Transportation</h3><br>
    <p>Every move is a ride on the bus, the underground or the famous london taxi. For such a ride, a matching ticket must be handed to Mister X. The traffic lines drawn on the game board correspond in color to the tickets. Each point is a stop for one or more means of transport. The colors of the stops indicate which means of transport may stop there.</p>

    <p class="tip"> Tip: The numbers of the stations on the game board
        are arranged from left to right to make it easier to find your starting positions.</p><br>
    <div class="one_piece">    <figure>
            <img src="images/one_piece.jpg"
                 alt="A station on the Scotland Yard game board."
                 title="Scotland Yard Station"
                 width="175"
                 height="200"
            />
            <figcaption>This station is a bus, taxi and underground station.<i>Game: Scotland Yard</i></figcaption>
        </figure></div>
    <p>The bus (turquoise) only drives from stations with a turquoise semi-circle; a bus will take you a little further than the taxi (along the bus line).<br>

        The underground (red) travels along the red line and covers the furthest distances the quickest. However, there are only a few underground stations (stations with a red inner rectangle) on the map.<br>

        A player uses a ticket with the corresponding color and moves his playing piece to the next station. You can move back along the same route on your next turn.<br>

        All playing pieces can only be moved to unoccupied stations. If there are no unoccupied stations for Mister X to travel to, he has lost the game. Mister X also loses if a detective moves to the station where Mister X is located.
        When a player is standing on a 'number' all possible moves light up.</p><br>
    <div class="misterX">
    </b><h3> Mister X</h3>
    <p>Mister X always makes the first move. This is not visible to the detectives. The means of transport is visible to the detectives.
        Mister X has several special moves:
        <Br><b>Appearing</b>, The location of "Mister X"  is shown regularly: the third, eighth, thirteenth, eighteenth and the last move.
        <br><b>Double move</b>, Mister X has two double cards. When playing such a card, he can choose a combination of two different means of transport. This double card is counted as two individual moves and he will also gives two tickets. If mister X must appear in the first move, he must show up there. With the second move, he immediately disappears again.
        <Br><b>Black tickets</b>, Mister X may use his black tickets every time it is his turn instead of the normal tickets (also with a double move).
        The black ticket applies to every means of transport and therefore means a black day for the detectives, because when using the card they do not receive any information about the means of transport that Mister X used. The black ticket is also the only ticket that can be used to travel by boat.</p></div>
</div>
<div class="button_row">
    <a href="/WP21/finalproject_webprog/index.php"><button type="submit" id="go-to-game-button" class=" ready-game-button">I'm ready to play!</button></a>
</div>
<?php
include __DIR__ . '/tpl/body_end.php';
?>