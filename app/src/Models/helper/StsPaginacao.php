<?php
namespace Src\Models\helper;

use \Src\Models\helper\StsRead;

class StsPaginacao
{
    private $Link;
    private $MaxLinks;
    private $Pagina;
    private $LimiteResultado;
    private $Offset;
    private $Query;
    private $ParseString;
    private $ResultBd;
    private $Resultado;
    private $TotalPaginas;

    public function getResultado()
    {
        return $this->Resultado;
    }

    public function getOffset()
    {
        return $this->Offset;
    }

    public function __construct($Link)
    {
        $this->Link = $Link;
        $this->MaxLinks = 4;
    }

    public function condicao($Pagina, $LimiteResultado)
    {
        $this->Pagina = (int) $Pagina ? $Pagina : 1;
        $this->LimiteResultado = (int) $LimiteResultado;
        $this->Offset = ($this->Pagina * $this->LimiteResultado) - $this->LimiteResultado;
    }

    public function paginacao($Query, $ParseString = null)
    {
        $this->Query = (string) $Query;
        $this->ParseString = (string) $ParseString;

        $contar = new StsRead();
        $contar->fullRead($this->Query, $this->ParseString);
        $this->ResultBd = $contar->getResultado();

        if ($this->ResultBd[0]['num_result'] > $this->LimiteResultado) {
            $this->instrucaoPaginacao();
        } else {
            $this->Resultado = null;
        }
    }

    private function instrucaoPaginacao()
    {
        $this->TotalPaginas = ceil($this->ResultBd[0]['num_result'] / $this->LimiteResultado);

        if ($this->TotalPaginas >= $this->Pagina) {
            //$this->layoutPaginacao();
            $this->dadosPaginacao();
        } else {
            header("Location: {$this->Link}");
        }
    }

    private function dadosPaginacao()
    {
        $this->Resultado = array(
                                'link' => "$this->Link",
                                'maxLinks' => "$this->MaxLinks",
                                'pagina' => "$this->Pagina",
                                'totalPaginas' => "$this->TotalPaginas"
                            );
    }
}
