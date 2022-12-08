<?php

namespace JustGo\Model\Dao;

use JustGo\Model\ObjectData\UserObjectData;

class UserDao extends Dao
{
    private $everyUserTable = [
        "UserInfo" => "T_User",
        "UserPassword" => "T_UserSecret",
        "UserAddresses" => "T_UserAddresses",
        "UserPhoto" => "T_UserPhoto",
        "UserPayements" => "T_UserPayement"
    ];
    private $userObj;
    public function __construct()
    {
        parent::__construct();
        $this->userObj = new UserObjectData();
    }
    public function createUser($fakeName, $firstName, $lastName, $email, $phoneNumber, $birthDate, $password)
    {
        $sqlStmtUserInfo = "INSERT INTO {$this->everyUserTable['UserInfo']} (User_FakeName, User_FirstName, User_LastName, User_Email, User_PhoneNumber, User_BirthDate) VALUES ('$fakeName', '$firstName', '$lastName', '$email' ,'$phoneNumber' ,'$birthDate');";
        if ($this->connection->query($sqlStmtUserInfo) === TRUE) {
            $id = $this->connection->insert_id;
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sqlStmtUserPassword = "INSERT INTO {$this->everyUserTable['UserPassword']} VALUES ($id, '$password');";
            if ($this->connection->query($sqlStmtUserPassword) === TRUE) {
                return $id;
            }
            $sqlStmtUserInfoDelete = "DELETE FROM {$this->everyUserTable['UserInfo']} WHERE User_ID = $id";
            $this->connection->query($sqlStmtUserInfoDelete);
        }
        return null;
    }
    public function loginUser($mail, $password)
    {
        $sqlStmtId = "SELECT User_ID, User_Permission FROM {$this->everyUserTable['UserInfo']} WHERE User_Email = '$mail'";
        $data = $this->connection->query($sqlStmtId);
        $data = $this->userObj->dataProcessing($data);
        if (isset($data[0]["User_ID"])) {
            $sqlStmtCheckPassword = "SELECT US_Password FROM {$this->everyUserTable['UserPassword']} WHERE User_ID = '{$data[0]["User_ID"]}'";
            $data2 = $this->connection->query($sqlStmtCheckPassword);
            $data2 = $this->userObj->dataProcessing($data2);
            if (isset($data[0]["User_ID"]) && password_verify($password, $data2[0]['US_Password'])) {
                return $data[0];
            }
        }
        return null;
    }

    public function getUsers($id = null)
    {
        $sqlStmt = "SELECT * FROM T_User WHERE User_ID = $id;";
        if ($id == null) {
            $sqlStmt = "SELECT * FROM T_User WHERE User_Permission = 0;";
        }
        $data = $this->connection->query($sqlStmt);
        return $this->userObj->dataProcessing($data);
    }

    public function deleteUser($id)
    {
        $sqlStmt = "DELETE FROM T_User WHERE User_ID = '$id';";
        $data = $this->connection->query($sqlStmt);
        $sqlStmt = "DELETE FROM T_UserSecret WHERE User_ID = '$id';";
        $data = $this->connection->query($sqlStmt);
        return $data;
    }

}