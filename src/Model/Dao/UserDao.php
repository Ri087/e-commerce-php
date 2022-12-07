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
    public function createUser($fakeName, $firstName, $lastName, $email, $phoneNumber, $birthDate, $salt, $password)
    {
        $sqlStmtUserInfo = "INSERT INTO {$this->everyUserTable['UserInfo']} (User_FakeName, User_FirstName, User_LastName, User_Email, User_PhoneNumber, User_BirthDate) VALUES ('$fakeName', '$firstName', '$lastName', '$email' ,'$phoneNumber' ,'$birthDate');";
        if ($this->connection->query($sqlStmtUserInfo) === TRUE) {
            $id = $this->connection->insert_id;
            $sqlStmtUserPassword = "INSERT INTO {$this->everyUserTable['UserPassword']} VALUES ($id, '$salt', '$password');";
            if ($this->connection->query($sqlStmtUserPassword) === TRUE) {
                return true;
            }
            $sqlStmtUserInfoDelete = "DELETE FROM {$this->everyUserTable['UserInfo']} WHERE User_ID = $id";
            $this->connection->query($sqlStmtUserInfoDelete);
        }
        return false;
    }

    public function getUsers($id = null)
    {
        $userObj = new UserObjectData();
        $sqlStmt = "SELECT * FROM T_User 
        INNER JOIN t_userphoto ON t_userphoto.User_ID = t_User.User_ID
        WHERE t_user.User_ID = $id";
        if ($id == null) {
            $sqlStmt = "SELECT * FROM T_User 
            INNER JOIN t_userphoto ON t_userphoto.User_ID = t_User.User_ID;";
        }
        $data = $this->connection->query($sqlStmt);
        return $userObj->dataProcessing($data);
    }

    public function deleteUser($id)
    {
        return $this->select("DELETE FROM T_User WHERE User_ID = $id;");

    }

}