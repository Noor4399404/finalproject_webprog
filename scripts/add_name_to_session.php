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
    "isHost" => $isHost
);

$gameSessionInfo = [
    "userId" => $userId,
    "gameId" => $gameId
];

foreach ($activeGameSessions as $key => $activeGameSession) {
    if ($activeGameSession["id"] === $gameId) {
        array_push($activeGameSessions[$key]["users"], $userObject);
    }
}

$_SESSION["gameId"] = $gameId;


$writableData = json_encode($activeGameSessions);
$json_file = fopen('../data/active_sessions.json', 'w'); 
fwrite($json_file, $writableData); 
fclose($json_file);

$answer = json_encode($gameSessionInfo);
echo $answer;
?>
