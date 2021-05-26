<?php

$gameId = intval($_POST["gameId"]);
$isHost = $_POST["isHost"];

$activeGameSessionsFile =  file_get_contents('../data/active_sessions.json', 'r');
$activeGameSessions = json_decode($activeGameSessionsFile, true);

foreach ($activeGameSessions as $key => $activeGameSession) {
    if ($activeGameSession["id"] === $gameId) {
        $activeGameSessions[$key]["gameStarted"] = true;
    }
}

$writableData = json_encode($activeGameSessions);
$json_file = fopen('../data/active_sessions.json', 'w'); 
fwrite($json_file, $writableData); 
fclose($json_file);

$answer = json_encode("joi");
echo $writableData;
?>
