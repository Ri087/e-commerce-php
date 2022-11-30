<?php
class InvoicesModel extends Database
{
    public function getInvoices()
    {
        return $this->select("SELECT * FROM T_Invoice;");
    }
}