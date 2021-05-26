<?php

$gameId = intval($_POST["gameId"]);
$userId = intval($_POST["userId"]);
$deleteUserId = intval($_POST["deleteUserId"]);

$activeGameSessionsFile =  file_get_contents('../data/active_sessions.json', 'r');
$activeGameSessions = json_decode($activeGameSessionsFile, true);

foreach ($activeGameSessions as $key => $activeGameSession) {
    if ($activeGameSession["id"] === $gameId) {
        $indexUserDeleting = array_search($userId, $activeGameSession["users"]);
        if ($activeGameSession["users"]["isHost"]) {
            $indexUserDeleted = array_search($deleteUserId, $activeGameSession["users"]);
            array_splice($activeGameSessions[$key]["users"], $activeGameSessions[$key]["users"][$indexUserDeleted], 1);
        }
    }
}

$answer = json_encode($currentGameInfo);
echo $answer;
?>
