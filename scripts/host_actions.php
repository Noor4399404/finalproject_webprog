<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


$gameId = intval($_POST["gameId"]);
$userId = intval($_POST["hostUserId"]);
$deleteUserId = intval($_POST["editedUserId"]);
$host_action = $_POST["action"];

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
                $indexUserEdited = $keySecond;
                array_push($message, $indexUserEdited);
            }
            if ($user["id"] == $userId) {
                $isHost = $user["isHost"];
            }
        }
        if ($isHost) {
            array_push($message, "user is goneeeeee");
            if ($host_action == "appointX") {
                $misterXCards = array( 
                    "tax" => 4,
                    "bus" => 3,
                    "und" => 3
                );
                $activeGameSessions[$key]["users"][$indexUserEdited]["isMisterX"] = true;
                $activeGameSessions[$key]["users"][$indexUserEdited]["myTurn"] = true;
                $activeGameSessions[$key]["users"][$indexUserEdited]["cardAmount"] = $misterXCards;
                $idUser = array_splice($activeGameSessions[$key]["orderRound"], array_search($activeGameSessions[$key]["users"][$indexUserEdited]["id"], $activeGameSessions[$key]["orderRound"]), 1)[0]; 
                array_splice($activeGameSessions[$key]["orderRound"], 0, 0, $idUser);
            } else if ($host_action == "delete") {
                array_push($activeGameSessions[$key]["userColors"], $activeGameSessions[$key]["users"][$indexUserEdited]["color"]);
                array_splice($activeGameSessions[$key]["users"], $indexUserEdited, 1);
            }
            array_push($message, [$key, $indexUserEdited, $activeGameSessions[$key]["users"]]);

            
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
