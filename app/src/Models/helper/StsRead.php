<?php
namespace Src\Models\helper;
use PDO;

class StsRead extends StsConn
{
    private $Select;
    private $Values;
    private $Resultado;
    private $Query;
    private $Conn;

    public function getResultado()
    {
        return $this->Resultado;
    }

    //* Metodo para trazer todas as colunas *//
    public function exeRead($Tabela, $Termos = null, $ParseString = null) {
        if(!empty($ParseString)){
            parse_str($ParseString, $this->Values);
        }

        $this->Select = "SELECT * FROM {$Tabela} {$Termos}";
        //echo " {$this->Select}";
        $this->exeInstrucao();
    }

    //* Metodo para trazer colunas especificas, inner join, etc *//
    public function fullRead($Query, $ParseString = null) {
        $this->Select = (string) $Query;
        if (!empty($ParseString)) {
            parse_str($ParseString, $this->Values);
        }

        $this->exeInstrucao();
    }

    private function exeInstrucao() {
        $this->conexao();

        try {
            $this->getInstrucao();
            $this->Query->execute();
            $this->Resultado = $this->Query->fetchAll();

        } catch (Exception $e) {
            $this->Resultado = null;
        }
    }

    private function conexao() {
        $this->Conn = parent::getConn();
        $this->Query = $this->Conn->prepare($this->Select);
        $this->Query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function getInstrucao() {
        if($this->Values){
            foreach ($this->Values as $Link => $Valor){
                if($Link == 'limit' || $Link == 'offset'){
                    $Valor= (int) $Valor;
                }

                $this->Query->bindValue(":{$Link}", $Valor, (is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }

}
