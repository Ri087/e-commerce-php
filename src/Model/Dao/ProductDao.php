<?php

namespace JustGo\Model\Dao;

use JustGo\Model\ObjectData\ProductObjectData;


class ProductDao extends Dao
{

    // A REFAIRE
    public function listProductByCategorie($name)
    {
        $productObjct = new ProductObjectData();
        $sqlStmt = "SELECT t_typeofproducts.TOP_ID, t_typeofproducts.TOP_Name, t_typeofproducts.TOP_Description, t_typeofproducts.TOP_DefaultPrice, t_typeofproducts.TOP_TVA, t_typeofproducts.TOP_Quantity , t_productscategory.Cate_Name, t_productsphoto.PP_Photo FROM t_typeofproducts
        INNER JOIN t_productscategory ON t_productscategory.TOP_ID = t_typeofproducts.TOP_ID
        INNER JOIN t_productsphoto ON t_productsphoto.TOP_ID = t_typeofproducts.TOP_ID
        WHERE t_productscategory.Cate_Name LIKE'%$name%'";
        $data = $this->connection->query($sqlStmt);
        return $productObjct->dataProcessing($data);
    }
    public function readProductById($id)
    {
        $productObjct = new ProductObjectData();
        $sqlStmt = "SELECT t_typeofproducts.TOP_ID, t_typeofproducts.TOP_Name , t_typeofproducts.TOP_Description, t_productsphoto.PP_Photo , t_typeofproducts.TOP_DefaultPrice, t_typeofproducts.TOP_Quantity, COUNT(t_rate.TOP_ID) AS rates, AVG(t_rate.Rate_Notation) AS average_rate FROM `t_typeofproducts`
        INNER JOIN t_productsphoto ON t_productsphoto.TOP_ID = t_typeofproducts.TOP_ID
        INNER JOIN t_rate ON t_rate.TOP_ID = t_typeofproducts.TOP_ID
        WHERE t_typeofproducts.TOP_ID = $id;";
        $data = $this->connection->query($sqlStmt);
        return $productObjct->dataProcessing($data);
    }

    public function listTypeOfProduct()
    {
        $productObjct = new ProductObjectData();
        $sqlStmt = "SELECT t_typeofproducts.TOP_ID, t_typeofproducts.TOP_Name , t_typeofproducts.TOP_Description, t_productsphoto.PP_Photo , t_typeofproducts.TOP_DefaultPrice, t_typeofproducts.TOP_Quantity FROM `t_typeofproducts`
        INNER JOIN t_productsphoto ON t_productsphoto.TOP_ID = t_typeofproducts.TOP_ID;";
        $data = $this->connection->query($sqlStmt);
        return $productObjct->dataProcessing($data);
    }



    public function createProduct($productName, $productDescription, $defautlPrice, $TVA, $productQuantity, $img)
    {

        $sqlStmtCreateProduct = "INSERT INTO t_typeofproducts (TOP_Name, TOP_Description, TOP_DefaultPrice ,TOP_TVA, TOP_Quantity )
        VALUES ('$productName','$productDescription', $defautlPrice, $TVA, $productQuantity);";

        if ($this->connection->query($sqlStmtCreateProduct) === TRUE) {
            $id = $this->connection->insert_id;
            $blob = base64_encode($img);
            $sqlStmtAddProductImg = "INSERT INTO t_productsphoto (TOP_ID, PP_Photo) VALUE ($id, '{$blob}');";
            if ($this->connection->query($sqlStmtAddProductImg) === TRUE) {
                return true;
            }

        }
        return false;
    }
    //value de t_typeOfProduct = TOP_ID, TOP_Name, TOP_Description, TOP_DefaultPrice, TOP_TVA, TOP_Quantity
    public function updateProduct($id, $column, $value)
    {
        return $this->connection->query("UPDATE `t_typeofproducts` SET {$column} = '$value' WHERE TOP_ID = $id;") === TRUE;
    }
    public function deleteProduct($id)
    {
        return $this->connection->query("DELETE FROM t_typeofproducts WHERE TOP_ID = '$id';") && $this->connection->query("DELETE FROM t_productsphoto WHERE TOP_ID = '$id';");
    }

    public function getAllRates($id)
    {
        $productObjct = new ProductObjectData();
        $data = $this->connection->query("SELECT t_rate.TOP_ID , t_rate.User_ID , t_rate.Rate_Description , t_rate.Rate_Notation , t_user.User_FakeName FROM t_rate
        INNER JOIN t_user ON t_rate.User_ID = t_user.User_ID
        WHERE t_rate.TOP_ID = $id
        ORDER BY t_rate.Rate_Notation DESC;");
        return $productObjct->dataProcessing($data);


    }
    public function createRate($productID, $content, $rate, $userID)
    {
        $this->connection->query("INSERT INTO t_rate (TOP_ID, User_ID, Rate_Description, Rate_Notation)
        VALUES ($productID, $userID, '$content', $rate);");
    }

}