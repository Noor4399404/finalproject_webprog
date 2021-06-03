<?php

if (isset($_POST['call_now'])){

    $activeGameSessionsFile =  file_get_contents('../data/test_sessions.json', 'r');
    $activeGameSessions = json_decode($activeGameSessionsFile, true);

    foreach ($activeGameSessions as $index => $gameSession){
        if($gameSession['id'] == intval($_POST["gameId"])){
            $gameSessionKey = $index;
        }
    }

    foreach ($activeGameSessions[$gameSessionKey]['users'] as $index => $player){
        echo "playerId: " . $player['id'] . "==" . intval($_POST["playerId"]);
        if($player['id'] == intval($_POST["playerId"])){
            $playerKey = $index;
        }
    }
    
    echo "playerKey: " . $playerKey;

    $activeGameSessions[$gameSessionKey]['users'][$playerKey] = [
        'cardAmount' => $_POST['cardAmount'],
        'myTurn' => $_POST['myTurn'],
        'hasMoved' => $_POST['hasMoved'],
        'location' => $_POST['location'],
        'previousLocation' => $_POST['previousLocation']
    ];

    echo '<pre>' . var_export($activeGameSessions, true) . '</pre>';

    $activeGameSessionsFile = fopen('../data/test_sessions.json', 'w');
    fwrite($activeGameSessionsFile, json_encode($activeGameSessions));
    fclose($activeGameSessionsFile);

}
?>