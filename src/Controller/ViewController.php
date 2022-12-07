<?php
namespace JustGo\Controller;

use JustGo\Controller\BaseController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewController extends BaseController
{
    private $loader;
    private $twig;
    private $invoices;
    private $product;
    private $user;
    function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../Views/templates');
        $this->twig = new Environment($this->loader);
        $this->invoices = new InvoicesController();
        $this->product = new ProductController();
        $this->user = new UserController();
    }

    public function display($page, $data = [])
    {
        echo $this->twig->render($page . '.html.twig', $data);
    }

    public function profil()
    {
        $data = $this->user->readAction(3);
        var_dump($data);
        $this->display("base");
    }

    public function productById($id)
    {
        $data = $this->product->readAction("readProductById",$id);
        var_dump($data);
        $this->display("home");
    }
    
    public function productByCategorieName($name){
        $data = $this->product->readAction("readProductByCategorieName", $name);
        var_dump($data);
        $this->display("home");
    }
    public function createProduct(){
        $data = $this->product->createAction();
        $this->display("home");
    }
    public function updateProduct(){
        $data = $this->product->updateAction(12,"TOP_Description", "hello world !");
        var_dump($data);
        $this->display("home");
    }
    public function deleteProduct($id){
        $data = $this->product->deleteAction($id);
        var_dump($data);
        $this->display("home");
    }



}

?>