<?php

$gameId = intval($_POST["gameId"]);

$activeGameSessionsFile =  file_get_contents('../data/active_sessions.json', 'r');
$activeGameSessions = json_decode($activeGameSessionsFile, true);

foreach ($activeGameSessions as $activeGameSession) {
    if ($activeGameSession["id"] === $gameId) {
        $arrayUsers = $activeGameSession["users"];
    }
}

$answer = json_encode($arrayUsers);
echo $answer;
?>
