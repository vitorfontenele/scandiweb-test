<?php

namespace App\Core;

class Controller
{
    protected function getRequestBody()
    {
        $json = file_get_contents("php://input");
        $obj = json_decode($json);

        return $obj;
    }

    public function model($model)
    {
        $modelToLower = strtolower($model);
        $model = ucfirst($modelToLower);
        require_once "../App/Models/" . $model . ".php";  
        return new $model;
    }
}