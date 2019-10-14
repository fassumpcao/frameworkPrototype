<?php
namespace App\src\Controllers;

 if(!defined('URL')){
     header("Location: /site_curso");
     exit();
 }

class Pagina
{
    private $Dados;
    private $PageId;

    public function pg($pg_num = 1) {

        //$this->PageId = filter_input(INPUT_GET, 'pg', FILTER_SANITIZE_NUMBER_INT);
        $this->PageId = $pg_num;
        $this->PageId = $this->PageId ? $this->PageId : 1;

        $listar_art = new \Src\Models\StsPagina();
        $this->Dados['dados'] = $listar_art->listarDados($this->PageId);
        $this->Dados['paginacao'] = $listar_art->getResultadoPg();
        //var_dump($this->Dados);die;
        $carregarView = new \Core\ConfigView('src/Views/pagina/pagina', $this->Dados);
        $carregarView->renderizar();
    }
}
