<?php

namespace Core;


class ConfigController
{

    private $Url;
    private $UrlConjunto;
    private $UrlController;
    private $UrlParametro;
    private $UrlMetodo;
    private $Classe;
    private $Paginas;
    private static $Format;
    private $Acesso;

    public function __construct($url = NULL)
    {
        if (!empty($url)) {

            $this->Url = $url;
            $this->limparUrl();
            $this->UrlConjunto = explode("/", $this->Url);

            if (isset($this->UrlConjunto[0])) {
                $this->UrlController = $this->slugController($this->UrlConjunto[0]);
            } else {
                $this->UrlController = $this->slugController(CONTROLER);
            }

            if (isset($this->UrlConjunto[1])) {
                $this->UrlMetodo = $this->slugMetodo($this->UrlConjunto[1]);
            } else {
                $this->UrlMetodo = $this->slugMetodo(METODO);
            }

            if (isset($this->UrlConjunto[2])) {
                $this->UrlParametro = $this->UrlConjunto[2];
            } else {
                $this->UrlParametro = null;
            }
        } else {
            $this->UrlController = $this->slugController(CONTROLER);
            $this->UrlMetodo = $this->slugMetodo(METODO);
            $this->UrlParametro = null;
        }

        echo "URL: {$this->Url} <br>";
        echo "Controlle: {$this->UrlController} <br>";
        echo "Metodo: {$this->UrlMetodo} <br>";
        echo "Parâmetro: {$this->UrlParametro} <br>";

    }

    private function limparUrl()
    {
        //Eliminar as tags
        $this->Url = strip_tags($this->Url);
        //Eliminar espaços em branco
        $this->Url = trim($this->Url);
        //Eliminar a barra no final da URL
        $this->Url = rtrim($this->Url, "/");

        self::$Format = array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
        $this->Url = strtr(utf8_decode($this->Url), utf8_decode(self::$Format['a']), self::$Format['b']);
    }

    public function slugController($SlugController)
    {
        $UrlController = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($SlugController)))));
        return $UrlController;
    }

    public function slugMetodo($SlugMetodo)
    {
        $UrlController = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($SlugMetodo)))));
        return lcfirst($UrlController);
    }

    public function carregar($login = false)
    {
        if(! $login){
            $acesso = new \App\src\Models\StsAcesso();
            $acesso->getAcesso();
            $this->Acesso = $acesso->getResultado();
        }

        if ($this->Acesso || $login) {

            $this->Classe = "\\App\\src\\Controllers\\" . $this->UrlController;
            if (class_exists($this->Classe)) {
                $this->carregarMetodo();
            } else {
                $this->UrlController = $this->slugController(CONTROLER);
                $this->UrlMetodo = $this->slugMetodo(METODO);
                $this->carregar();
            }
        } else {
            $this->UrlController = $this->slugController(CONTROLER_LOGIN);
            $this->UrlMetodo = $this->slugMetodo(METODO);
            $this->carregar(true);
        }

    }

    private function carregarMetodo()
    {
        $classeCarregar = new $this->Classe;
        if(method_exists($classeCarregar, $this->UrlMetodo)){

            if($this->UrlParametro !== null){
                $classeCarregar->{$this->UrlMetodo}($this->UrlParametro);
            }else{
                $classeCarregar->{$this->UrlMetodo}();
            }

        }else{
            $this->UrlController = $this->slugController(CONTROLER);
            $this->UrlMetodo = $this->slugMetodo(METODO);
            $this->carregar();
        }
    }

}
