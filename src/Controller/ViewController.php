<?php
namespace JustGo\Controller;

use JustGo\Controller\BaseController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewController extends BaseController
{
    private $loader;
    private $twig;
    function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../Views/templates');
        $this->twig = new Environment($this->loader);
    }

    public function display($page, $data = [])
    {
        echo $this->twig->render($page . '.html.twig', $data);
    }

}

?>