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
        array_push($message, $activeGameSession["id"]);


        foreach ($activeGameSession["users"] as $keySecond => $user) {
            if ($user["id"] == $deleteUserId) {
                array_push($message, "user is almost goneeeeee");
                $indexUserDeleted = $keySecond;
                array_push($message, $indexUserDeleted);
            } else if ($user["id"] == $userId) {
                $isHost = $user["isHost"];
            }
        }
        if ($isHost) {
            array_push($message, "user is goneeeeee");
            array_push($message, [$key, $indexUserDeleted, $activeGameSessions[$key]["users"]]);

            array_splice($activeGameSessions[$key]["users"], $indexUserDeleted, 1);
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
