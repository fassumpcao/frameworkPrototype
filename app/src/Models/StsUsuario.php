<?php
namespace Src\Models;

if (! defined('URL')) {
    header("Location: /site_curso");
    exit();
}


class StsUsuario
{
    private $Resultado;
    private $User;

    public function getData($IdUser = null) {
        $this->User = (string) $IdUser;
        $data = new \Src\Models\helper\StsRead();
        $data->fullRead('SELECT iduser, username, deslogin, despassword, inadmin, dtregister
                                FROM users
                                WHERE iduser = :iduser
                                LIMIT :limit',
                                "iduser={$this->User}&limit=1");
        $this->Resultado = $data->getResultado();
        
        return $this->Resultado;

    }
}
