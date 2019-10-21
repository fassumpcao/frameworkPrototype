<?php

namespace App\src\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsLogin
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class StsAcesso
{
    private $Resultado;

    function getResultado()
    {
        return $this->Resultado;
    }

    public function checkAcesso()
    {
        // ** Implementar
        if(isset($_SESSION['logado'])){
            $this->Resultado = $_SESSION['logado'];
        } else {
            $this->Resultado = false;
        }

        return $this->Resultado;

    }

}
