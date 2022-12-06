<?php
namespace JustGo\Controller;

use JustGo\Controller\BaseController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewController extends BaseController
{


    public function display()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Views/templates');
        $twig = new Environment($loader);
        echo $twig->render("base" . '.html.twig', );
    }

}

?>