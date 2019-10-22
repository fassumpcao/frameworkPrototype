<?php

namespace App\src\Models;

use \Src\Models\helper\StsSession;

class StsAcesso
{
    private $Data;
    private $Resultado;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function getAcesso()
    {
        $session = new StsSession();

        if($session->getFieldValue("logado")){
            $this->Resultado = true;
        }  else {
            $this->Resultado = false;
        }

    }

    public function unsetAcesso()
    {
        $session = new StsSession();
        $session->unsetField("logado");
    }

    public function setAcesso()
    {
        $session = new StsSession();
        $session->setData(array('logado' => true));

    }

}
