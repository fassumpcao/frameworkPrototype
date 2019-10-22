<?php
session_start();
ob_start(); //limpar buffer de redirecionamento


define('URL', 'http://localhost/frameworkPrototype');
//define('URLADM', 'http://local.website.com.br/adm');

define('CONTROLER', 'Home');
define('CONTROLER_LOGIN', 'Login');
define('METODO', 'index');
define('CONTROLER_ERROR', 'Error');
define('SRC_VIEWS_PATH', '/src/Views/');

//Credenciais do BD
define('HOST', 'localhost');
define('USER', 'desenv');
define('PASS', '');

//define('USER', 'desenv');
//define('PASS', '1/2doM@t0');
define('DBNAME', 'teste_desenvolvimento');
