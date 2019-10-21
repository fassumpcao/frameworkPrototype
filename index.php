<?php

    require './core/Config.php';
    require './vendor/autoload.php';

    $url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

    print_r("SESSION: ".$_SESSION['logado']);
    echo "<br>";

    use Core\ConfigController as Home;
    $Url = new Home($url);
    $Url->carregar();

?>
