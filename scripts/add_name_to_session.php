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
    "isMisterX" => false
);

$gameSessionInfo = [
    "userId" => $userId,
    "gameId" => $gameId,
    "tooManyPlayers" => false
];

foreach ($activeGameSessions as $key => $activeGameSession) {
    if ($activeGameSession["id"] === $gameId && count($activeGameSession["users"]) < 5) {
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
