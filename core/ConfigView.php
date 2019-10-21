<?php
namespace Core;

class ConfigView
{
    private $Nome;
    private $Dados;

    public function __construct($Nome, array $Dados = null)
    {
        $this->Nome = (string) $Nome;
        $this->Dados = $Dados;
    }

    public function renderizar($flgLogin = false)
    {
        if (file_exists('app/' . $this->Nome . '.php')) {
            require_once 'app/src/Views/includes/header.php';
            if($flgLogin === false){
                require_once 'app/src/Views/includes/menu.php';
            }
            require_once 'app/' . $this->Nome . '.php';
            require_once 'app/src/Views/includes/footer.php';
        } else {
            require_once 'app/src/Views/error/404.php';
        }
    }

}
