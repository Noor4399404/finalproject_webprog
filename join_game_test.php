<?php
/* Header */

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$page_title = 'Webprogramming Final assignment';
$navigation = array(
    'active' => 'test join',
    'items' => array(
        'Home' => '/WP21/finalproject_webprog/index.php',
        'How To Play' => '/WP21/finalproject_webprog/game_rules.php'
    )
);
include __DIR__ . '/tpl/head.php';
include __DIR__ . '/tpl/body_start.php';

$isAdmin = false;

if (isset($_POST["host-game-id"])) {
    $isAdmin = true;
    $found_session_id = true;
    $gameId = intval($_POST["host-game-id"]);

    $activeGameSessionsFile =  file_get_contents('data/active_sessions.json', 'r');
    $activeGameSessions = json_decode($activeGameSessionsFile, true);

    $gameSession = [
        "id" => $gameId,
        "users" => array()
    ];

    array_push($activeGameSessions, $gameSession);
    $activeGameSessionsFile = json_encode($activeGameSessions);
    file_put_contents('data/active_sessions.json', $activeGameSessionsFile);

    $message = "You have created session #$gameId";
} else if (isset($_POST["join-game-id"])) {
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
<h1>You have joined a game</h1>

<?php
echo $message;

if ($found_session_id) {
?>
    <form id="join-game-form">
        <input type="hidden" id="is-admin" name="game-id" value="<?php echo $isAdmin;?>">
        <input type="hidden" id="game-id" name="game-id" value="<?php echo $gameId;?>">
        <input type="text" class="form-control mb-2" placeholder="Your name" id="user-name-input" name="user-name-input">
        <button id="join-game-name" class="btn btn-primary">Join Game!</button>
    </form>

    <form id="start-game-form" class="d-none">
        <button id="join-game-name" class="btn btn-primary">Start Game!</button>
    </form>
<?php
} else {
?>
    <p>Go <a href="./index.php">home</a> to start or join a game</p>
<?php
}
?>


<script>
    function joinGame() {
        $("#join-game-name").click(function(event) {
            event.preventDefault();
            var randomUserId = Math.floor(Math.random() * 10000000);
            console.log($("#game-id").val(),);
            let request = $.post("./scripts/add_name_to_session.php", {
                gameId: $("#game-id").val(),
                userId: randomUserId,
                userName: $("#user-name-input").val(),
                isAdmin: $("#is-admin").val()
            });
            request.then((response) => {
                $("#join-game-form").addClass("d-none");
                $("#start-game-form").removeClass("d-none");
            })
        });
    }
    joinGame();
</script>

<?php
include __DIR__ . '/tpl/body_end.php';
?>