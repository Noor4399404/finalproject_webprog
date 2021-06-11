<?php


$gameId = intval($_POST["gameId"]);
$userId = intval($_POST["userId"]);
$newUserInfo = json_decode($_POST["newUserInfo"]);

echo json_encode($userId);

$activeGameSessionsFile = file_get_contents('../data/active_sessions.json', 'r');
$activeGameSessions = json_decode($activeGameSessionsFile, true);

foreach ($activeGameSessions as $key => $activeGameSession) {
    if ($activeGameSessions[$key]["id"] == $gameId) {
        foreach ($activeGameSession["users"] as $index => $user) {
            if ($user["id"] == $userId) {
                $activeGameSessions[$key]["users"][$index] = $newUserInfo;
            } else {
                $activeGameSessions[$key]["users"][$index]["hasRecentVersion"] = false;
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
echo json_encode($newUserInfo);