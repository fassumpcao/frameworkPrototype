<?php

namespace App\src\Controllers;

if(!defined('URL')){
    header("Location: /site_curso");
    exit();
}

class Error
{
    private $Dados;

    public function index() {

        //Carrega a view e envia os dados
        $carregarView = new \Core\ConfigView("src/Views/error/404", $this->
            Dados);
        $carregarView->renderizar();
    }
}
