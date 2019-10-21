<?php

namespace App\src\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class StsLogin
{

    private $Dados;
    private $Resultado;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function acesso(array $Dados)
    {
        $this->Dados = $Dados;

        $this->validarDados();
        if ($this->Resultado) {
            $validaLogin = new \Src\Models\helper\StsRead();
            $validaLogin->fullRead("SELECT user.iduser, user.username, user.deslogin, user.despassword, user.inadmin, user.dtregister
                    FROM users user
                    WHERE deslogin =:deslogin LIMIT :limit", "deslogin={$this->Dados['usuario']}&limit=1");
            $this->Resultado = $validaLogin->getResultado();
            if (!empty($this->Resultado)) {
                $this->validarSenha();
            } else {
                $this->Resultado = false;
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Usuário ou a senha incorreto!</div>";
            }
        }

    }

    private function validarDados()
    {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)) {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário preencher todos os campos!</div>";
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function validarSenha()
    {
        //if (password_verify($this->Dados['senha'], $this->Resultado[0]['senha'])) {
        if ($this->Dados['senha'] == $this->Resultado[0]['despassword']) {
            $_SESSION['usuario_id'] = $this->Resultado[0]['iduser'];
            $_SESSION['usuario_nome'] = $this->Resultado[0]['username'];
            $_SESSION['usuario_email'] = $this->Resultado[0]['deslogin'];
            $_SESSION['logado'] = true;
            $this->Resultado = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Usuário ou a senha incorreto!</div>";
            $this->Resultado = false;
        }
    }

}
