<?php


$gameId = intval($_POST["gameId"]);
$userId = intval($_POST["userId"]);

$activeGameSessionsFile = file_get_contents('../data/active_sessions.json', 'r');
$activeGameSessions = json_decode($activeGameSessionsFile, true);

foreach ($activeGameSessions as $key => $activeGameSession) {
    if ($activeGameSessions[$key]["id"] == $gameId) {
        foreach ($activeGameSession["users"] as $index => $user) {
            if ($user["id"] == $userId) {
                if ($user["hasRecentVersion"]) {
                    $answerArray = array(
                        "isChanged" => false
                    );
                    $answer = json_encode($answerArray);
                    
                } else {
                    $activeGameSession[$key]["users"][$index]["hasRecentVersion"] = true;
                    $answer = json_encode($activeGameSession);
                }
            }
        }
        break;
    }
}
$writableData = json_encode($activeGameSessions);
$json_file = fopen('../data/active_sessions.json', 'w'); 
fwrite($json_file, $writableData); 
fclose($json_file);
header('Content-Type: application/json');
echo $answer;