<?php

namespace JustGo\Controller;

use Error;
use JustGo\Model\Dao\UserDao;

class UserController extends BaseController
{
    private $userDB = null;
    private $userObject = null;

    public function __construct()
    {
        $this->userDB = new UserDao();
    }

    /**
     * Create our profil
     */
    public function createAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $dataUser = $_POST;
        if (strtoupper($requestMethod) == 'POST') {
            if ($this->checkRegister($dataUser)) {
                try {
                    $uid = $this->userDB->createUser($dataUser["pseudo"], $dataUser["firstname"], $dataUser["lastname"], $dataUser["mail"], $dataUser["number"], $dataUser["birthdate"], $dataUser["password"]);
                    if (!$uid) {
                        $this->strErrorDesc = 'Ressource might already exist';
                        $this->strErrorHeader = 'HTTP/1.1 409 Conflict';
                    }
                } catch (Error $e) {
                    $this->strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                    $this->strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
            } else {
                $this->strErrorDesc = 'Cannot be understood';
                $this->strErrorHeader = 'HTTP/1.1 400 Bad Request';
            }
        } else {
            $this->strErrorDesc = 'Method not supported';
            $this->strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        if ($this->strErrorHeader) {
            header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/login');

        } else {
            $_SESSION["uid"] = $uid;
            $_SESSION["permission"] = 0;
            header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/');
        }
    }
    private function checkRegister($dataUserRegister)
    {
        if (strlen($dataUserRegister['pseudo']) < 3 || strlen($dataUserRegister['pseudo']) > 32) {
            return false;
        }
        if (strlen($dataUserRegister['firstname']) < 3 || strlen($dataUserRegister['lastname']) > 32) {
            return false;
        }
        if (strlen($dataUserRegister['lastname']) < 3 || strlen($dataUserRegister['lastname']) > 64) {
            return false;
        }
        if ($dataUserRegister['password'] != $dataUserRegister['confirmpassword']) {
            return false;
        }
        return true;
    }

    /**
     * Get our information (/!\ Admin - Get user information)
     */
    public function readAction($id = null)
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $data = $this->userDB->getUsers($id);
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

    /**
     * Update our information (/!\ Admin - Update user information)
     */
    public function updateAction($id)
    {
    }

    /**
     * Delete our profil (/!\ Admin - Delete a profil)
     */
    public function deleteAction($id)
    {
        var_dump($id);
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            try {
                if (!$this->userDB->deleteUser($id)) {
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
            header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/admin/users/' . $id);
        } else {
            header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/admin/users');
        }
    }

    public function loginAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $dataUser = $_POST;
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $data = $this->userDB->loginUser($dataUser["mail"], $dataUser["password"]);
                if (!$data['User_ID']) {
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
            header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/login');
        } else {
            $_SESSION["uid"] = $data['User_ID'];
            $_SESSION["permission"] = $data['User_Permission'];
            header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/');
        }
    }

    public function logoutAction()
    {
        unset($_SESSION["uid"]);
        unset($_SESSION["permission"]);
        header('Location: /e-commerce-php-les-bests-benjou-et-jeremoux/');
    }
}