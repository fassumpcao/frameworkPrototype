<?php

namespace App\src\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Login
{

    private $Dados;

    public function index()
    {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->Dados['SendLogin'])) {
            unset($this->Dados['SendLogin']);

            $acessoLogin = new \App\src\Models\StsLogin();
            $acessoLogin->acesso($this->Dados);

            if ($acessoLogin->getResultado()) {
                $UrlDestino = URL . '/'.CONTROLER.'/'.METODO;
                header("Location: $UrlDestino");
            } else {                
                $this->Dados['form'] = $this->Dados;
            }
        }
        $carregarView = new \Core\ConfigView("src/Views/login/acesso", $this->Dados);
        $carregarView->renderizar(true);
    }

    public function logout()
    {
        unset($_SESSION['usuario_id'], $_SESSION['usuario_nome'], $_SESSION['usuario_email'], $_SESSION['usuario_imagem'], $_SESSION['adms_niveis_acesso_id'], $_SESSION['ordem_nivac'], $_SESSION['logado']);

        $_SESSION['msg'] = "<div class='alert alert-success'>Deslogado com sucesso</div>";

        $UrlDestino = URL . '/login';
        header("Location: $UrlDestino");
    }

}
