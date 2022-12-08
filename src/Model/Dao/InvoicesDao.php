<?php

namespace JustGo\Model\Dao;

class InvoicesModel extends Dao
{
    public function readInvoice($id)
    {
        return $this->select("SELECT * FROM `t_invoice` WHERE invo_ID = $id");
    }  

}