<?php

    require './core/Config.php';
    require './vendor/autoload.php';

    var_dump(filter_input(INPUT_GET, 'url', FILTER_DEFAULT));

    use Core\ConfigController as Home;
    $Url = new Home();
    $Url->carregar();
?>
