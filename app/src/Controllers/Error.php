<?php

namespace App\src\Controllers;

use \Core\ConfigView;

class Error
{
    private $Dados;

    public function index() {

        //Carrega a view e envia os dados
        $carregarView = new ConfigView(SRC_VIEWS_PATH . "error/404", $this->
            Dados);
        $carregarView->renderizar();
    }
}
