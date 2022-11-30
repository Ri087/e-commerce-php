<?php

class UserController extends BaseController
{
    /**
     * "/user/create/[id]" Endpoint - Create our profil
     */
    public function createAction()
    {}

    /**
     * "/user/read/[id]" Endpoint - Get our information (/!\ Admin - Get user information)
     */
    public function readAction()
    {}

    /**
     * "/user/update/[id]" Endpoint - Update our information (/!\ Admin - Update user information)
     */
    public function updateAction()
    {}

    /**
     * "/user/delete/[id]" Endpoint - Delete our profil (/!\ Admin - Delete a profil)
     */
    public function deleteAction()
    {}

    /**
     * "/user/list" Endpoint - Get list of users
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();
                $arrUsers = $userModel->getUsers();
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        $this->ifError($strErrorDesc, $strErrorHeader, $responseData);
    }
}