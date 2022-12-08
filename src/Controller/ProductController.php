<?php

namespace JustGo\Controller;

use Error;
use JustGo\Model\Dao\ProductDao;


class ProductController extends BaseController
{

    private $productDB = null;

    public function __construct()
    {
        $this->productDB = new ProductDao();
    }

    public function createAction()
    {
        var_dump($_POST);
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            try {
                if (!$this->productDB->createProduct($_POST['name'], $_POST['description'], $_POST['price'], $_POST['tva'], $_POST['quantity'], $_POST['img'])) {
                    $this->strErrorDesc = 'Ressource not create !';
                    $this->strErrorHeader = 'HTTP/1.1 409 Conflict';
                }
            } catch (Error $e) {
                $this->strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $this->strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }

        } else {
            $this->strErrorDesc = 'Method not supported';
            $this->strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        return [
            "strErrorDesc" => $this->strErrorDesc,
            "strErrorHeader" => $this->strErrorHeader
        ];
    }
    public function readAction($function, $id = null)
    {
        $data = null;

        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $data = $this->productDB->{$function}($id);
                if (!$data) {
                    $this->strErrorDesc = 'User not found';
                    $this->strErrorHeader = 'HTTP/1.1 404 Not Found';
                }
            } catch (Error $e) {
                $this->strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $this->strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }

        } else {
            $this->strErrorDesc = 'Method not supported';
            $this->strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        return [
            "data" => $data,
            "strErrorDesc" => $this->strErrorDesc,
            "strErrorHeader" => $this->strErrorHeader
        ];
    }


    public function updateAction($id, $column)
    {
        $content = $_POST[$column];
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $data = $this->productDB->updateProduct($id, $column, $content);
                if (!$data) {
                    $this->strErrorDesc = 'User not found';
                    $this->strErrorHeader = 'HTTP/1.1 404 Not Found';
                }
            } catch (Error $e) {
                $this->strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $this->strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }

        } else {
            $this->strErrorDesc = 'Method not supported';
            $this->strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/admin/products/' . $id);
    }
    public function deleteAction($id)
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $data = $this->productDB->deleteProduct($id);
                if (!$data) {
                    $this->strErrorDesc = 'User not found';
                    $this->strErrorHeader = 'HTTP/1.1 404 Not Found';
                }
            } catch (Error $e) {
                $this->strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $this->strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }

        } else {
            $this->strErrorDesc = 'Method not supported';
            $this->strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        if ($this->strErrorHeader) {
            header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/admin/products/' . $id);
        } else {
            header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/admin/products');
        }
    }
    public function cartAdd($id)
    {
        $data = null;
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $data = $this->productDB->readProductById($id);

                if (!$data) {
                    $this->strErrorDesc = 'User not found';
                    $this->strErrorHeader = 'HTTP/1.1 404 Not Found';
                }
            } catch (Error $e) {
                $this->strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $this->strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $this->strErrorDesc = 'Method not supported';
            $this->strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        $_SESSION['products'][$id] += 1;
        header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/cart');

    }
    public function cartDeleteItem($id)
    {
        if ($_SESSION['products'][$id] > 1) {
            $_SESSION['products'][$id] -= 1;
        } else {
            unset($_SESSION['products'][$id]);

        }
        header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/cart');
    }

}