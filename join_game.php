<?php
/* Header */
session_start();


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$page_title = 'Webprogramming Final assignment';
$navigation = array(
    'active' => 'Join Game',
    'items' => array(
        'Home' => '/WP21/finalproject_webprog/index.php',
        'Join Game' => '/WP21/finalproject_webprog/join_game_test.php',
        'How To Play' => '/WP21/finalproject_webprog/game_rules.php'
    )
);
include __DIR__ . '/tpl/head.php';
include __DIR__ . '/tpl/body_start.php';

$isHost = false;

if (isset($_POST["host-game-id"])) {
    $isHost = true;
    $found_session_id = true;
    $gameId = intval($_POST["host-game-id"]);


    $activeGameSessionsFile =  file_get_contents('data/active_sessions.json', 'r');
    $activeGameSessions = json_decode($activeGameSessionsFile, true);

    if (is_null($activeGameSessions)) {
        $activeGameSessions = [];
    }

    // sometimes the json file will have a value of null, because of some actions. We cannot trace back what is causing the json file to be null, but if it does have a value of null, you can still start a game

    $newGameId = true;

    foreach ($activeGameSessions as $key => $activeGameSession) {
        if ($gameId === $activeGameSession["id"]) {
            $newGameId = false;
            break;
        }
    }

    if ($newGameId) {
        $gameSession = [
            "id" => $gameId,
            "users" => array(),
            "userColors" => array("05dffc", "f78809", "f70909", "ac09f7", "e814cb"),
            "round" => 1,
            "startLocations" => [13, 26, 29, 34, 50, 53, 94, 103, 112, 117, 132, 138, 141, 155, 174, 197, 198],
            "gameStarted" => false,
            "isChanged" => true,
            "misterXFound" => false,
            "misterXEscaped" => false,
            "orderRound" => array()
        ];
        $activeGameSessions = array_slice($activeGameSessions, -100, 100);

        array_push($activeGameSessions, $gameSession);
        $activeGameSessionsFile = json_encode($activeGameSessions);
        file_put_contents('data/active_sessions.json', $activeGameSessionsFile);

        $message = "You have created session #$gameId";
    } else {
        $found_session_id = false;
        $message = "this game id already exists, try recreating a game id by hosting another game <a href='./index.php'>here</a>";
    }
} else if (isset($_POST["join-game-id"]) && $_POST["join-game-id"] != 0) {
    $gameId = intval($_POST["join-game-id"]);


    $activeGameSessionsFile =  file_get_contents('data/active_sessions.json', 'r');
    $activeGameSessions = json_decode($activeGameSessionsFile, true);

    $found_session_id = false;
    foreach ($activeGameSessions as $activeGameSession) {
        if ($activeGameSession["id"] === $gameId) {
            $found_session_id = true;
            break;
        }
    }

    if ($found_session_id) {
        $message = "you have joined session #$gameId";
    } else {
        $message = "that game id does not exist, try another";
    }
} else {
    $message = "no game id found";
    $found_session_id = false;
}
?>

<div class="container mt-3 mb-5">

    <?php
    if ($found_session_id) {
    ?>
        <?php if ($isHost) { ?>
            <h1>You are hosting a game</h1>
        <?php } else { ?>
            <h1>You are joining a game</h1>
        <?php } ?>
        
        <div class="row wp-row d-flex mt-4">
            <div class="d-flex flex-column mb-4 col-md-12">
                <div id="game-id-card" class="card my-3">
                    <div class="card-body">
                        <h3 class="text-center m-0">#<?php echo $gameId; ?></h3>
                    </div>
                </div>
                <div>
                    <p id="copy-game-id-info" class="text-muted">Click the game ID to copy it to your clipboard. Share the code with friends so they can join this session.</p>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <h3 class="mb-3">Enter your name to join</h3>
                <form id="join-game-form">
                    <input type="hidden" id="is-host" name="game-id" value="<?php echo $isHost; ?>">
                    <input type="hidden" id="game-id" name="game-id" value="<?php echo $gameId; ?>">
                    <input type="text" class="form-control mb-3" placeholder="Your name" id="user-name-input" name="user-name-input">
                    <div class="invalid-feedback mb-3" id="username-input-feedback">

                    </div>
                    <button id="join-game-name" class="btn button-green-primary">Join Game!</button>
                    <?php if ($isHost) { ?>
                        <button id="end-game-button" class="btn btn-danger">End game</button>
                    <?php } ?>
                </form>



                <?php if ($isHost) { ?>
                    <form action="./game.php" method="POST" id="start-game-form" class="d-none">
                        <input type="hidden" name="is-host" value="<?php echo $isHost; ?>">
                        <button href="./start_game_join_test.php" id="start-game" class="btn button-green-primary">Start Game!</button>
                        <button id="end-game-button-2" class="btn btn-danger">End game</button>
                    </form>
                    <div class="d-none" id="start-game-feedback-text">
                        <p id="start-game-feedback-paragraph" class="text-danger"></p>
                    </div>
                <?php
                } else {
                ?> <p class="text-muted mt-3">Join here and wait for the host to start the game.</p>
                <?php
                } ?>


            </div>

            <div class="col-md-6 mb-3">
                <h3 class="mb-3">Joined users</h3>
                <ul class="list-group" id="list-joined-users">
                </ul>
            </div>


        <?php
    } else {
        echo $message;
        ?>
            <p>Go <a href="./index.php">home</a> to start or join a game</p>
        <?php
    }
        ?>



        </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
