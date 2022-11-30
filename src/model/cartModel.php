<?php
class CartModel extends Database
{
    public function getCart()
    {
        return $this->select("SELECT * FROM T_User;");
    }
}