<?php

namespace App\src\Controllers;

use \Core\ConfigView;
use \Src\Models\StsUsuario;

class Formulario
{
    private $Dados;
    private $IdUser;

    public function index() {

        $this->Dados['usuario'] = NULL;

        $carregarView = new ConfigView("src/Views/formulario/formulario", $this->
            Dados);
        $carregarView->renderizar();
    }

    public function exibirUsuario($idUser = NULL) {

        $this->IdUser = $idUser;
        $dadosUsuario = new StsUsuario();
        $this->Dados['usuario'] = $dadosUsuario->getData($this->IdUser);

        $carregarView = new ConfigView("src/Views/formulario/formulario", $this->
            Dados);
        $carregarView->renderizar();
    }
}
