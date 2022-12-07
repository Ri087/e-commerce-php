<?php

namespace JustGo\Model\ObjectData;

class UserObjectData
{
    function dataProcessing($data)
    {
        return $data->fetch_all(MYSQLI_ASSOC);
    }

}