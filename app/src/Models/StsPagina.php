<?php
namespace Src\Models;

if (! defined('URL')) {
    header("Location: /site_curso");
    exit();
}


class StsPagina
{
    private $Resultado;
    private $PageId;
    private $ResultadoPg;
    private $LimiteResultado = 3;

    public function getResultadoPg()
    {
        return $this->ResultadoPg;
    }

    public function listarDados($PageId = null) {

        $this->PageId = (int) $PageId;
        $paginacao = new \Src\Models\helper\StsPaginacao(URL . '/pagina');
        $paginacao->condicao($this->PageId, $this->LimiteResultado);
        $paginacao->paginacao('SELECT COUNT(iduser) AS num_result
                        FROM users
                        WHERE inadmin = :inadmin', 'inadmin=1');
        $this->ResultadoPg = $paginacao->getResultado();

        $listar = new \Src\Models\helper\StsRead();
        $listar->fullRead('SELECT iduser, username, deslogin, despassword, inadmin, dtregister
                        FROM users
                        WHERE inadmin = :inadmin
                        ORDER BY iduser ASC
                        LIMIT :limit OFFSET :offset', "inadmin=1&limit={$this->LimiteResultado}&offset={$paginacao->getOffset()}");
        $this->Resultado = $listar->getResultado();


        return $this->Resultado;
    }
}
