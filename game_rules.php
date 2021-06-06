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
    </ul></p>

    Every time a detective uses a ticket, this ticket is given to Mister X.

    <p class="tip"> Tip: To play the role of Mister X you need nerves of steel,
        so it's best if the most experienced player gives it his best shot.</p>



    <Br><h3>Transportation</h3><br>
    <p>Every move is a ride on the bus, the underground or the famous london taxi. For such a ride, a matching ticket must be handed to Mister X. The traffic lines drawn on the game board correspond in color to the tickets. Each point is a stop for one or more means of transport. The colors of the stops indicate which means of transport may stop there.</p>

    <p class="tip"> Tip: The numbers of the stations on the game board
        are arranged from left to right to make it easier to find your starting positions.</p><br>
    <div class="one_piece">    <figure>
            <img src="images/taxi_station.jpg"
                 alt="A station on the Scotland Yard game board."
                 title="Scotland Yard Station"
                 width="175"
                 height="200"
            />
            <figcaption><i>Station 1</i></figcaption>
        </figure></div>
    <div class="one_piece">    <figure>
            <img src="images/bus_station.jpg"
                 alt="A station on the Scotland Yard game board."
                 title="Scotland Yard Station"
                 width="175"
                 height="200"
            />
            <figcaption><i>Station 2</i></figcaption>
        </figure></div>
    <div class="one_piece">    <figure>
            <img src="images/one_piece.jpg"
                 alt="A station on the Scotland Yard game board."
                 title="Scotland Yard Station"
                 width="175"
                 height="200"
            />
            <figcaption><i>Station 3</i></figcaption>
        </figure></div>
    <p>Every station is a taxi station (<i>station 1</i>). The bus  only drives from stations with a turquoise semi-circle (<i>station 2</i>). A bus will take you a little further than the taxi (along the bus line).<br>

        The underground travels along the red line and covers the furthest distances the quickest. However, there are only a few underground stations (<i>station 3</i>) on the map.<br>

        A player uses a ticket with the corresponding color and moves his playing piece to the next station. You can move back along the same route on your next turn.<br>

        All playing pieces can only be moved to unoccupied stations. If there are no unoccupied stations for Mister X to travel to, he has lost the game. Mister X also loses if a detective moves to the station where Mister X is located.
        When a player is standing on a 'number' all possible moves light up.</p><br>
    <div class="misterX">
    </b><h3> Mister X</h3><br>
    <p>Mister X always makes the first move. This is not visible to the detectives. The means of transport is visible to the detectives.
        Mister X has several special moves:<br>
        <Br><b>Appearing</b>, The location of "Mister X"  is shown regularly: the third, eighth, thirteenth, eighteenth and the last move.<br>
        <br><b>Double move</b>, Mister X has two double cards. When playing such a card, he can choose a combination of two different means of transport. This double card is counted as two individual moves and he will also gives two tickets. If mister X must appear in the first move, he must show up there. With the second move, he immediately disappears again.<Br>
        <Br><b>Black tickets</b>, Mister X may use his black tickets every time it is his turn instead of the normal tickets (also with a double move).<br>
        The black ticket applies to every means of transport and therefore means a black day for the detectives, because when using the card they do not receive any information about the means of transport that Mister X used. The black ticket is also the only ticket that can be used to travel by boat.</p></div>
    <div>
        still want to add: <br>
        - explain chat function <br>
        - explain submit button <br>
        -
    </div>
    <div class="vehicles_explained">
        <div class="border-warning border vehicle_info_div">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5H15V3H9v2H6.5c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z" />
                <circle cx="7.5" cy="14.5" r="1.5" />
                <circle cx="16.5" cy="14.5" r="1.5" />
            </svg>
        </div>
        <div class="border-info border vehicle_info_div">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M12 2c-4.42 0-8 .5-8 4v10c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4zm5.66 2.99H6.34C6.89 4.46 8.31 4 12 4s5.11.46 5.66.99zm.34 2V10H6V6.99h12zm-.34 9.74l-.29.27H6.63l-.29-.27C6.21 16.62 6 16.37 6 16v-4h12v4c0 .37-.21.62-.34.73z" />
                <circle cx="8.5" cy="14.5" r="1.5" />
                <circle cx="15.5" cy="14.5" r="1.5" />
            </svg>
            <p>this image will tell you</p>
        </div>
        <div class="border-danger border vehicle_info_div">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M17.8 2.8C16 2.09 13.86 2 12 2s-4 .09-5.8.8C3.53 3.84 2 6.05 2 8.86V22h20V8.86c0-2.81-1.53-5.02-4.2-6.06zM9.17 20l1.5-1.5h2.66l1.5 1.5H9.17zm-2.16-6V9h10v5h-10zm9.49 2c0 .55-.45 1-1 1s-1-.45-1-1 .45-1 1-1 1 .45 1 1zm-8-1c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM20 20h-3.5v-.38l-1.15-1.16c1.49-.17 2.65-1.42 2.65-2.96V9c0-2.63-3-3-6-3s-6 .37-6 3v6.5c0 1.54 1.16 2.79 2.65 2.96L7.5 19.62V20H4V8.86c0-2 1.01-3.45 2.93-4.2C8.41 4.08 10.32 4 12 4s3.59.08 5.07.66c1.92.75 2.93 2.2 2.93 4.2V20z" />
            </svg>
        </div>
    </div>
</div>
<div class="button_row">
    <a href="/WP21/finalproject_webprog/index.php"><button type="submit" id="go-to-game-button" class=" ready-game-button">I'm ready to play!</button></a>
</div>
<?php
include __DIR__ . '/tpl/body_end.php';
?>