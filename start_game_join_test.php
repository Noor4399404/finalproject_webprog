<?php
session_start();
/* Header */
$page_title = 'Webprogramming Final assignment';
$navigation = array(
    'active' => 'Home',
    'items' => array(
        'How To Play' => '/WP21/finalproject_webprog/game_rules.php',
        'Test_movement' => '/WP21/finalproject_webprog/test_movement.php'
    )
);
include __DIR__ . '/tpl/head.php';
include __DIR__ . '/tpl/body_start.php';

$isHost = $_POST["is-host"];
?>

<script src="./scripts/create_and_join_sessions.js"></script>


<form>
    <input type="hidden" name="isHost" id="isHost" value='<?php echo $_SESSION["isHost"]; ?>'>
    <input type="hidden" name="gameId" id="gameId" value='<?php echo $_SESSION["gameId"]; ?>'>
    <input type="hidden" name="userId" id="userId" value='<?php echo $_SESSION["userId"]; ?>'>
</form>

<?php echo $_SESSION["isHost"]; ?> <br>

<div id="print-ids">

</div>

<button id="end-game-button" class="btn btn-danger">End game</button>

<script>
    $(function() {
        let gameId = sessionStorage.getItem("gameId");
        let userId = sessionStorage.getItem("userId");
        $("#print-ids").html(`${gameId}<br>${userId}`);

        $("#end-game-button").click(function() {
            let request = $.post("./scripts/end_game_session.php", {
                gameId: sessionStorage.getItem("gameId"),
                isHost: $("#is-host").val()
            })
            request.then((response) => {
                window.location.href = "./index.php";
            })
        })

    });
</script>

<?php
include __DIR__ . '/tpl/body_end.php';
?>