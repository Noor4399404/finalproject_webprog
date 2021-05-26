<?php

$gameId = intval($_POST["gameId"]);
$userId = intval($_POST["userId"]);
$deleteUserId = intval($_POST["deleteUserId"]);

$activeGameSessionsFile =  file_get_contents('../data/active_sessions.json', 'r');
$activeGameSessions = json_decode($activeGameSessionsFile, true);

$message = array();

foreach ($activeGameSessions as $key => $activeGameSession) {
    if ($activeGameSession["id"] === $gameId) {
        array_push($message, "found game session");

        foreach ($activeGameSession["users"] as $keySecond => $user) {
            if ($user["id"] == $deleteUserId) {
                array_push($message, "user is almost goneeeeee");
                $indexUserDeleted = $key;
            } else if ($user["id"] == $userId) {
                $isHost = $user["isHost"];
            }
        }
        if ($isHost) {
            array_push($message, "user is goneeeeee");
            array_splice($activeGameSessions[$key]["users"], $activeGameSessions[$key]["users"][$indexUserDeleted], 1);
        }
    }
}

$writableData = json_encode($activeGameSessions);
$json_file = fopen('../data/active_sessions.json', 'w'); 
fwrite($json_file, $writableData); 
fclose($json_file);

$answer = json_encode($message);
echo $answer;
?>
