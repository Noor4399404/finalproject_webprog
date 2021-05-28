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

    die();
}


if (isset($_POST["submit"])) {
    echo("<script>console.log('PHP: " . $_POST["submit"] . "');</script>");

    $json_file = file_get_contents("data/possible_moves.json");
    $buttons = json_decode($json_file, true);

    $active_button = $_POST['submit'];
    foreach ($buttons as $key => $value) {
        if ($active_button == $key) {
            $tax_value = $value["tax"];
            if ($tax_value == " ") {
                $tax_value = "No Moves!";
            }
            $bus_value = $value["bus"];
            if ($bus_value == " ") {
                $bus_value = "No Moves!";
            }
            $und_value = $value["und"];
            if ($und_value == " ") {
                $und_value = "No Moves!";
            }
            echo "<td>$tax_value</td>";
            echo "<td>$bus_value</td>";
            echo "<td>$und_value</td>";
        }
    }
} ?>
