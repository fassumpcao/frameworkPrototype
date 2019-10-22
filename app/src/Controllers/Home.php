<?php

namespace App\src\Controllers;
use \Core\ConfigView;

class Home
{
    private $Dados;

    public function index() {

        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        /*
        //Exemplo de carga de dados à partir das Models

        $listarMenu = new \Sts\Models\StsMenu();
        $this->Dados['menu'] = $listarMenu->listarMenu();

        $listarSeo = new \Sts\Models\StsSeo();
        $this->Dados['seo'] = $listarSeo->listarSeo();
s
        */

        //Teste de envio de dados para o form
        //$this->Dados['teste'] =  json_encode(array("campo1" => "1", "campo2" => "2"));

        //Carrega a view e envia os dados
        $carregarView = new ConfigView(SRC_VIEWS_PATH . "/home/home", $this->
            Dados);
        $carregarView->renderizar();
    }
}
