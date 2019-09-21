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

    public function renderizar()
    {
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/src/Views/includes/header.php';
            include 'app/src/Views/includes/menu.php';
            include 'app/' . $this->Nome . '.php';
            include 'app/src/Views/includes/footer.php';
        } else {
            include 'app/src/Views/error/404.php';
        }
    }
}
