<?php

namespace App\src\Controllers;

use \App\src\Models\StsLogin;
use \App\src\Models\StsAcesso;
use \Core\ConfigView;

class Login
{
    private $Dados;

    public function index()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->Dados['SendLogin'])) {
            unset($this->Dados['SendLogin']);

            $login = new StsLogin();
            $login->acesso($this->Dados);

            if ($login->getResultado()) {
                $acesso = new StsAcesso();
                $acesso->setAcesso();
                header("Location: " . URL . '/'. CONTROLER . '/' .METODO);
            } else {
                $this->Dados['form'] = $this->Dados;
            }
        } else {
            $acesso = new StsAcesso();
            $acesso->unsetAcesso();
        }

        $carregarView = new ConfigView(SRC_VIEWS_PATH . "login/acesso", $this->Dados);
        $carregarView->renderizar(true);
    }

    public function logout()
    {
        $login = new StsLogin();
        $login->logout();

        header("Location: ".URL . '/login');
    }
}
