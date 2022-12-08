<?php

namespace JustGo\Model\ObjectData;

class ProductObjectData
{
    function dataProcessing($data)
    {
        return $data->fetch_all(MYSQLI_ASSOC);
    }
}