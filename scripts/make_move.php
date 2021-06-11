<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


$gameId = intval($_POST["gameId"]);
$userId = intval($_POST["userId"]);
$newUserInfo = json_decode($_POST["newUserInfo"], true);

echo json_encode($userId);

$activeGameSessionsFile = file_get_contents('../data/active_sessions.json', 'r');
$activeGameSessions = json_decode($activeGameSessionsFile, true);

foreach ($activeGameSessions as $key => $activeGameSession) {
    if ($activeGameSessions[$key]["id"] == $gameId) {
        $indexUserTurn = array_search($userId, $activeGameSessions[$key]["orderRound"]);

        if ($indexUserTurn + 1 == count($activeGameSessions[$key]["orderRound"])) {
            $activeGameSessions[$key]["round"] += 1;
            $nextUserTurnId = $activeGameSessions[$key]["orderRound"][0];
        } else {
            $nextUserTurnId = $activeGameSessions[$key]["orderRound"][$indexUserTurn + 1];
        }
        // The id of the user who can make a move is determined.

        if ($activeGameSessions[$key]["round"] == 23) {
            $activeGameSessions[$key]["misterXEscaped"] = true;
            // Mister X won the game by escaping for 23 rounds
        }
        
        foreach ($activeGameSession["users"] as $index => $user) {
            if ($user["id"] == $userId) {
                array_push($activeGameSessions[$key]["users"][$index]["usedVehicles"], $newUserInfo["lastUsedVehicle"]);
                $activeGameSessions[$key]["users"][$index] = $newUserInfo;
                $activeGameSessions[$key]["users"][$index]["myTurn"] = false;
            } else if ($user["id"] == $nextUserTurnId) {
                $activeGameSessions[$key]["users"][$index]["myTurn"] = true;
                $activeGameSessions[$key]["users"][$index]["hasRecentVersion"] = false;
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
