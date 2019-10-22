<?php

namespace App\src\Models;

use \Src\Models\helper\StsRead;
use \Src\Models\helper\StsSession;

class StsLogin
{
    private $Dados;
    private $Resultado;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function acesso(array $Dados)
    {
        $this->Dados = $Dados;

        $this->validarDados();
        if ($this->Resultado) {
            $validaLogin = new StsRead();
            $validaLogin->fullRead("SELECT user.iduser, user.username, user.deslogin, user.despassword, user.inadmin, user.dtregister
                    FROM users user
                    WHERE deslogin =:deslogin LIMIT :limit", "deslogin={$this->Dados['usuario']}&limit=1");
            $this->Resultado = $validaLogin->getResultado();
            if (!empty($this->Resultado)) {
                $this->validarSenha();
            } else {
                $sessionSetError = new StsSession();
                $sessionSetError->setMsgError("<div class='alert alert-danger'>Erro: Usuário ou a senha incorreto!</div>");
                $this->Resultado = false;
            }
        }
    }

    private function validarDados()
    {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)) {
            $sessionSetError = new StsSession();
            $sessionSetError->setMsgError("<div class='alert alert-danger'>Erro: Necessário preencher todos os campos!</div>");
            $this->Resultado = false;
        } else {
            $this->Resultado = true;
        }
    }

    private function validarSenha()
    {
        //if (password_verify($this->Dados['senha'], $this->Resultado[0]['senha'])) {
        if ($this->Dados['senha'] == $this->Resultado[0]['despassword']) {
            $session = new StsSession();
            $session->setData($this->Resultado[0]);

            $this->Resultado = true;
        } else {
            $session = new StsSession();
            $session->setMsgError("<div class='alert alert-danger'>Erro: Usuário ou a senha incorreto!</div>");
            $this->Resultado = false;
        }
    }

    public function logout()
    {
        $session = new StsSession();
        $session->unsetData();
        $session->setMsgSuccess("<div class='alert alert-success'>Deslogado com sucesso</div>");

        return true;
    }
}
