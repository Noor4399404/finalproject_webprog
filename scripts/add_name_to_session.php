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

foreach ($activeGameSessions as $activeGameSession) {
    if ($activeGameSession["id"] === $gameId) {
        $arrayUsers = $activeGameSession["users"];
        array_push($arrayUsers, $userObject);

        $editedGameSession = [
            "id" => $gameId,
            "users" => $arrayUsers
        ];
        $indexGameSession = array_search($activeGameSession ,$activeGameSessions);
        $activeGameSessions[$indexGameSession] = $editedGameSession;
    }
}

$_SESSION["gameId"] = $gameId;
$_SESSION["userId"] = $userId; 

$writableData = json_encode($activeGameSessions);
$json_file = fopen('../data/active_sessions.json', 'w'); 
fwrite($json_file, $writableData); 
fclose($json_file);

$answer = json_encode($activeGameSessions);
echo $answer;
?>
