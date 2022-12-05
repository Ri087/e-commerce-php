<?php

namespace JustGo\Model\Dao;

class ProductDao extends Dao
{
    public function listProducts($name)
    {
        return $this->select("SELECT * FROM `t_product` INNER JOIN t_typeofproducts ON t_product.TOP_ID = t_typeofproducts.TOP_ID WHERE t_typeofproducts.TOP_Name = $name; ");
        
    }
    public function readProduct($id)
    {
        return $this->select("SELECT * FROM t_product WHERE TOP_ID = $id; ");

    }
    public function createProduct($type_of_product, $suplier)
    {
        $this->select("INSERT INTO t_product (TOP_ID , Supp_ID)
        VALUES ('$type_of_product','$suplier');");

    }
    public function deleteProduct($id)
    {
        return $this->select("DELETE FROM t_product WHERE Prod_ID = $id;");
    }

}