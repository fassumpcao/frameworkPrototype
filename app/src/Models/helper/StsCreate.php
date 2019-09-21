<?php
namespace Src\Models\helper;

use PDO;

if (! defined('URL')) {
    header("Location: /site_curso");
    exit();
}

class StsCreate extends StsConn
{
    private $Tabela;
    private $Dados;
    private $Resultado;
    private $Query;
    private $Conn;

    function getResultado(){
        return $this->Resultado;
    }

    public function exeCreate($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        $this->getInstrucao();
        $this->executarInstrucao();
    }

    private function getInstrucao(){
        $colunas = implode(', ', array_keys($this->Dados));
        $valores = ':' . implode(', :', array_keys($this->Dados));
        $this->Query = "INSERT INTO {$this->Tabela} ({$colunas}) VALUES ({$valores}) ";
    }

    private function executarInstrucao() {
        $this->conexao();
        try {
            $this->Query->execute($this->Dados);
            $this->Resultado = $this->Conn->lastInsertId();

        } catch (Exception $e) {
            $this->Resultado = null;
        }
    }

    private function conexao() {
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Query);
    }
}
