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

    public function profil()
    {
        $data = $this->user->readAction($_SESSION['uid']);
        var_dump($data);
        // $this->display("base");
    }

    public function home()
    {
        $data = $this->product->readAction("listTypeOfProduct");
        $this->display("home", $data);
    }

    public function cart()
    {
        $this->display("cart");
    }
    public function productById($id)
    {
        $data = $this->product->readAction("readProductById", $id);
        var_dump($_SESSION);
        $this->display("product", $data);
    }

    public function productByCategorieName($name)
    {
        $data = $this->product->readAction("listProductByCategorie", $name);
        var_dump($data);
        $this->display("home");
    }
    public function createProduct()
    {
        $data = $this->product->createAction();
        $this->display("home");
    }
    public function updateProduct()
    {
        $data = $this->product->updateAction(12, "TOP_Description", "hello world !");
        var_dump($data);
        $this->display("home");
    }
    public function deleteProduct($id)
    {
        $data = $this->product->deleteAction($id);
        var_dump($data);
        $this->display("home");
    }



    public function login()
    {
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
        if (isset($_GET['search']))
        {
            $pattern = "/{$_GET['search']}/i";
            foreach ($data['data'] as $key => $value) {
                if (preg_match($pattern, $value['User_FakeName']) == 0 && preg_match($pattern, $value['User_FirstName']) == 0 && preg_match($pattern, $value['User_LastName']) == 0)
                {
                    unset($data['data'][$key]);
                }
            }
        }
        $this->adminDisplay("users", $data);
    }
    public function adminUsersId($id = null)
    {
        $data = $this->user->readAction($id);
        $this->adminDisplay("usersId", $data);
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