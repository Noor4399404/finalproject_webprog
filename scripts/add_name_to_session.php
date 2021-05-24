<?php

$gameId = intval($_POST["gameId"]);
$userId = intval($_POST["userId"]);
$userName = $_POST["userName"];
$isAdmin = $_POST["isAdmin"];

$activeGameSessionsFile =  file_get_contents('../data/active_sessions.json', 'r');
$activeGameSessions = json_decode($activeGameSessionsFile, true);

$userIdName = array();
array_push($userIdName, $userId);
array_push($userIdName, $userName);

$userObject = array(
    "id" => $userId,
    "userName" => $userName,
    "isAdmin" => $isAdmin
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

$writableData = json_encode($activeGameSessions);
$json_file = fopen('../data/active_sessions.json', 'w'); 
fwrite($json_file, $writableData); 
fclose($json_file);

// $newFILE = json_encode("hoi");
// file_put_contents('../data/active_sessions.json', $newFILE);

$answer = json_encode($activeGameSessions);
echo $answer;
?>
