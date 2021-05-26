<?php
/* Header */
session_start();


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$page_title = 'Webprogramming Final assignment';
$navigation = array(
    'active' => 'test join',
    'items' => array(
        'Join Game' => '/WP21/finalproject_webprog/join_game_test.php',
        'Home' => '/WP21/finalproject_webprog/index.php',
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
            "gameStarted" => false
        ];
    
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

<script src="./scripts/create_and_join_sessions.js"></script>


<div class="container mt-3 mb-5">

    <?php
    if ($found_session_id) {
    ?>
        <h1>You can join a game</h1>
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
                    <button id="join-game-name" class="btn btn-primary">Join Game!</button>
                    <?php if ($isHost) { ?>
                    <button id="end-game-button" class="btn btn-danger">End game</button>
                    <?php } ?>
                </form>
                


                <?php if ($isHost) { ?>
                    <form action="./start_game_join_test.php" method="POST" id="start-game-form" class="d-none">
                        <input type="hidden" name="is-host" value="<?php echo $isHost; ?>">
                        <button href="./start_game_join_test.php" id="start-game" class="btn btn-primary">Start Game!</button>
                        <button id="end-game-button" class="btn btn-danger">End game</button>
                    </form>
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

<?php
include __DIR__ . '/tpl/body_end.php';
?>