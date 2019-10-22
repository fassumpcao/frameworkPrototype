<?php
namespace App\src\Controllers;

use \Core\ConfigView;
use \Src\Models\StsPagina;

class Pagina
{
    private $Dados;
    private $PageId;

    public function pg($pg_num = 1) {

        $this->PageId = $pg_num;
        $this->PageId = $this->PageId ? $this->PageId : 1;

        $listar_art = new StsPagina();
        $this->Dados['dados'] = $listar_art->listarDados($this->PageId);
        $this->Dados['paginacao'] = $listar_art->getResultadoPg();

        $carregarView = new ConfigView(SRC_VIEWS_PATH . "/pagina/pagina", $this->Dados);
        $carregarView->renderizar();
    }
}
