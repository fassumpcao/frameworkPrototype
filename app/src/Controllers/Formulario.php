<?php

namespace App\src\Controllers;

if(!defined('URL')){
    header("Location: /site_curso");
    exit();
}

class Formulario
{
    private $Dados;
    private $IdUser;

    public function index() {
        
        $this->Dados['usuario'] = NULL;

        $carregarView = new \Core\ConfigView("src/Views/formulario/formulario", $this->
            Dados);
        $carregarView->renderizar();
    }

    public function exibirUsuario($idUser = NULL) {

        $this->IdUser = $idUser;
        $dadosUsuario = new \Src\Models\StsUsuario();
        $this->Dados['usuario'] = $dadosUsuario->getData($this->IdUser);

        $carregarView = new \Core\ConfigView("src/Views/formulario/formulario", $this->
            Dados);
        $carregarView->renderizar();
    }
}
