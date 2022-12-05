<?php
namespace JustGo\Controller;

use JustGo\Controller\BaseController;

class ViewController extends BaseController
{

    public function home()
    {
        return $this->render("/src/Views/baseTemplate.html.twig");
    }

}

?>