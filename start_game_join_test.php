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

<form>
    <input type="hidden" name="isHost" id="isHost" value='<?php echo $_SESSION["isHost"]; ?>'>
    <input type="hidden" name="gameId" id="gameId" value='<?php echo $_SESSION["gameId"]; ?>'>
    <input type="hidden" name="userId" id="userId" value='<?php echo $_SESSION["userId"]; ?>'>
</form>


<script>
    function startGame() {
        let request = $.post("./scripts/start_game_session.php", {
            gameId: $("#gameId").val(),
            isHost: $("#isHost").val()
        });
        request.then((response) => {
            console.log(response);
            console.log("Other players are starting now as well");
        })
    }
    $(function() {
        startGame();
    })
</script>


<?php
include __DIR__ . '/tpl/body_end.php';
?>