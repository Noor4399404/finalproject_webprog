<?php
// P_Print function
function p_print($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $page_title ?></title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <!-- Scripts -->
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>
    <script src="./scripts/main.js"></script>
    <script src="./scripts/sessions.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" id="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="./index.php">Scotland Yard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" style="border: none;">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="navbar-nav">
                        <?php $active = $navigation['active']; ?>
                        <?php foreach ($navigation['items'] as $title => $url) {
                            if ($title == $active) { ?>
                                <li class="nav-item active">
                                    <a class="nav-link text-light active_page" href="<?= $url ?>"><?= $title ?></a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="<?= $url ?>"><?= $title ?></a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>