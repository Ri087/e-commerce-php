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
        $this->invoices = new InvoicesController();
        $this->product = new ProductController();
        $this->user = new UserController();
    }

    public function display($page, $data = [])
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Views/templates');
        $twig = new Environment($loader);
        echo $twig->render($page . '.html.twig', $data);
    }

    public function errorCheck($data)
    {
        if ($data["strErrorHeader"]) {
            var_dump($data);
            // $this->display("error", $data);
        } else {
            $this->display("base");
        }
    }
    public function home()
    {

        $this->display("base");
    }
    public function profil()
    {
        $data = $this->user->readAction(123123);
        $this->errorCheck($data);
    }

    public function login()
    {
        if (isset($_SESSION['uid'])) {
            header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/profil');
            exit(0);
        }
        $this->display("login");
    }
    public function adminDisplay($page, $data = [])
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Views/templates/admin');
        $twig = new Environment($loader);
        echo $twig->render($page . '.html.twig', $data);
    }

    public function admin()
    {
        $this->adminDisplay("home");
    }
    public function adminUsers()
    {
        $data = $this->user->readAction();
        $this->adminDisplay("users", $data);
    }
    public function adminProducts()
    {
        $this->adminDisplay("products");
    }
    public function adminCommand()
    {
        $this->adminDisplay("command");
    }
}

?>