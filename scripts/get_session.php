<?php

if (isset($_POST['call_now'])){

    $gameId = intval($_POST["gameId"]);

    $activeGameSessionsFile =  file_get_contents('../data/test_sessions.json', 'r');
    $activeGameSessions = json_decode($activeGameSessionsFile, true);
    
    foreach ($activeGameSessions as $activeGameSession) {
        if ($activeGameSession["id"] === $gameId) {
            $currentGameInfo = $activeGameSession;
        }
    }
    
    $answer = json_encode($currentGameInfo);
    echo $answer;
}
?>