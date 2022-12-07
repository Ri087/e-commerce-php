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
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            try {
                // RECUPERER INFORMATION FROM FORMULAIRE
                if (!$this->productDB->createProduct("macbook", "apple mac", 12600, 0.2, 900, "https://i.imgur.com/UYcHkKD.png")) {
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


    public function updateAction($id, $column, $content)
    {
        $data = null;

        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
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
        return [
            "data" => $data,
            "strErrorDesc" => $this->strErrorDesc,
            "strErrorHeader" => $this->strErrorHeader
        ];
    }
    public function deleteAction($id)
    {
        $data = null;

        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
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
        return [
            "data" => $data,
            "strErrorDesc" => $this->strErrorDesc,
            "strErrorHeader" => $this->strErrorHeader
        ];
    }
}