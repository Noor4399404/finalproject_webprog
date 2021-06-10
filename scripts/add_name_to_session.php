<?php
session_start();

$gameId = intval($_POST["gameId"]);
$userId = intval($_POST["userId"]);
$userName = $_POST["userName"];
$isHost = $_POST["isHost"];

$activeGameSessionsFile =  file_get_contents('../data/active_sessions.json', 'r');
$activeGameSessions = json_decode($activeGameSessionsFile, true);

$userObject = array(
    "id" => $userId,
    "userName" => $userName,
    "isHost" => $isHost,
    "isMisterX" => "",
    "color" => "",
    "location" => 0,
    "hasMoved" => false,
    "myTurn" => false,
    "cardAmount" => array(
        "tax" => 10,
        "bus" => 8,
        "und" => 4
    ),
    "hasRecentVersion" => false,
    "usedVehicles" => array()
);

$gameSessionInfo = [
    "userId" => $userId,
    "gameId" => $gameId,
    "tooManyPlayers" => false
];

foreach ($activeGameSessions as $key => $activeGameSession) {
    if ($activeGameSession["id"] === $gameId && count($activeGameSession["users"]) < 5) {
        $randomColorIndex = mt_rand(0, count($activeGameSessions[$key]["userColors"]) - 1);
        $randomStartLocationIndex = mt_rand(0, count($activeGameSessions[$key]["startLocations"]) - 1);

        $userIds = [];
        foreach ($activeGameSessions[$key]["users"] as $secondKey => $user) {
            array_push($userIds, $user["id"]);
        }
        while (in_array($userId, $userIds)) {
            $userId = mt_rand(1000000, 9999999);
            $userObject["id"] = $userId;
            $gameSessionInfo["userId"] = $userId;
        }
        // $hex_color = $activeGameSessions[$key]["userColors"][$randomColorIndex];
        // array_splice($activeGameSessions[$key]["userColors"], $randomColorIndex, 1);
        // $newUserInfo = ["userColor" => $hex_color];
        // $userObject = array_merge($userObject, $newUserInfo);
        // array_push($activeGameSessions[$key]["users"], $userObject);

        
        $newUserInfo = ["color" => array_splice($activeGameSessions[$key]["userColors"], $randomColorIndex, 1)[0], "location" => array_splice($activeGameSessions[$key]["startLocations"], $randomStartLocationIndex, 1)[0]];
        $userObject = array_merge($userObject, $newUserInfo);
        array_push($activeGameSessions[$key]["users"], $userObject);
    } else if ($activeGameSession["id"] === $gameId) {
        $gameSessionInfo["tooManyPlayers"] = true;
    }
}

$_SESSION["gameId"] = $gameId;


$writableData = json_encode($activeGameSessions);
$json_file = fopen('../data/active_sessions.json', 'w'); 
fwrite($json_file, $writableData); 
fclose($json_file);

$answer = json_encode($gameSessionInfo);
header("Content-Type: application/json");
echo $answer;
?>
