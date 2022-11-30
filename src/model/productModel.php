<?php
class ProductModel extends Database
{
    public function getProducts()
    {
        return $this->select("SELECT * FROM T_Product;");
    }
}