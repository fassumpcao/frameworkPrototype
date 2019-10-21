<?php
namespace Test;

use PHPUnit\Framework\TestCase;
include_once("core/Config.php");
use Core\ConfigController;

class ConfigControllerTest extends TestCase
{

    public function setUp():void
    {

    }

    public function testCarregar()
    {
        $teste = new ConfigController("classe/metodo/param");
        print_r($teste->carregar());
        //print_r($teste);
        //print_r(json_encode($teste));
        exit;

        $teste = new ConfigController("Pagina/pg/2");

    }


}
