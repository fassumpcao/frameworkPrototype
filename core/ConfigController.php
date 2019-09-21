<?php

    namespace Core;

/**
    *
    * Classe
    *
    **/

    class ConfigController
    {
        private $Url;
        private $UrlConjunto;
        private $UrlController;
        private $UrlParametro;
        private $Classe;
        private $Paginas;
        private static $Format;

        public function __construct()
        {
            if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
                $this->Url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
                $this->limparUrl();
                $this->UrlConjunto = explode("/", $this->Url);

                //Trata Controller
                if (isset($this->UrlConjunto[0])) {
                    $this->UrlController = $this->slugController($this->UrlConjunto[0]);
                } else {
                    $this->UrlController = $this->slugController(CONTROLER);
                }

                //Trata Parametro
                if (isset($this->UrlConjunto[1])) {
                    $this->UrlParametro = $this->UrlConjunto[1];
                } else {
                    $this->UrlParametro = null;
                }
            } else {
                $this->UrlController = $this->slugController(CONTROLER);
                $this->UrlParametro = null;
            }

            //echo "$this->UrlParametro";die;
            //echo "$this->UrlController";
        }

        private function limparUrl()
        {
            //Eliminar as tagas
            $this->Url = strip_tags($this->Url);

            //Eliminar espacos em branco
            $this->Url = trim($this->Url);

            //Eliminar ultima barra
            $this->Url = rtrim($this->Url, "/");

            //Elimina caracteres especiais
            self::$Format = array();
            self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
            self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
            $this->Url = strtr(utf8_decode($this->Url), utf8_decode(self::$Format['a']), self::$Format['b']);
        }

        //Converte para minusculo
        private function slugController($SlugController)
        {
            /*
            $UrlController = strtolower($SlugController);
            $UrlController = explode("-", $UrlController);
            $UrlController = implode(" ", $UrlController);
            $UrlController = ucwords($UrlController);
            $UrlController = str_replace(" ", "", $UrlController);
            */
            $UrlController = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($SlugController)))));
            return $UrlController;
        }

        public function carregar()
        {
            //$listarPg = new \Src\Models\StsPaginas();
            //$this->Paginas = $listarPg->listarPaginas($this->UrlController);
            //var_dump($this->UrlController);die;
            //if($this->Paginas){
            //extract($this->Paginas[0]);
            //$this->Classe = "\\App\\{$tipo_tpg}\\Controllers\\" . $this->UrlController;
            $this->Classe = "\\App\\Src\\Controllers\\" . $this->UrlController;

            if (class_exists($this->Classe)) {
                $this->carregarMetodo();
            } else {
                $this->UrlController = $this->slugController(CONTROLER_ERROR);
                $this->carregar();
            }
            //} else {
            //    $this->UrlController = $this->slugController(CONTROLER);
            //    $this->carregar();
            //}
        }

        private function carregarMetodo()
        {

            //echo "<br><br><br>";
            $classeCarregar = new $this->Classe;

            if (method_exists($classeCarregar, "index")) {
                if ($this->UrlParametro !== null) {
                    
                    $classeCarregar->index($this->UrlParametro);
                } else {
                    $classeCarregar->index();
                }
            } else {
                $this->UrlController = $this->slugController(CONTROLER_ERROR);
                $this->carregar();
            }
        }
    }
