<?php
if (isset($_POST['call_now'])) {

    $json_file = file_get_contents("data/possible_moves.json");
    $buttons = json_decode($json_file, true);

    $articles_html = "";
    foreach ($buttons as $key => $value){
        $articles_html.= '<table class="table">';
        $articles_html.= '<thead>';
        $articles_html.= '<tr>';
        $articles_html.= '<th scope="col">Taxi</th>';
        $articles_html.= '<th scope="col">Bus</th>';
        $articles_html.= '<th scope="col">Underground</th>';
        $articles_html.= '</tr>';
        $articles_html.= '</thead>';
        $articles_html.= '<tbody>';
        $articles_html.= '<tr>';
        $articles_html.= sprintf('<td class="card-text">%s</td>', $value['tax']);
        $articles_html.= sprintf('<td class="card-text">%s</td>', $value['bus']);
        $articles_html.= sprintf('<td class="card-text">%s</td>', $value['und']);
        $articles_html.= '</tr>';
    }
    $export_data = [
        'html' => $articles_html
    ];
    // Return JSON
    header('Content-Type: application/json');
    echo json_encode($export_data);
}
