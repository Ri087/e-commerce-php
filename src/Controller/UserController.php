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
        if (strtoupper($requestMethod) == 'GET') {
            try {
                // RECUPERER INFORMATION FROM FORMULAIRE
                if (!$this->userDB->createUser("", "", "", "", "", "", "", "")) {
                    $this->strErrorDesc = 'Ressource might already exist';
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
    public function updateAction()
    {
    }

    /**
     * Delete our profil (/!\ Admin - Delete a profil)
     */
    public function deleteAction()
    {
    }
}