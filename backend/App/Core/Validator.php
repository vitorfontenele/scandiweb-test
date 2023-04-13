<?php

namespace App\Core;

class Validator {
    public function validator($model)
    {   
        $modelToLower = strtolower($model);
        $validator = ucfirst($modelToLower) . "Validator";
        require_once "../App/Validators/" . $validator . ".php";
        return new $validator;
    }

    protected function validateRequiredStr($parameter, $parameterName){
        if (!isset($parameter) || !is_string($parameter)){
            $message = $parameterName . " must be informed and be a string";
            ResponseHandler::respondWithError($message, 400);
        }
    }

    protected function validateRequiredNum($parameter, $parameterName){
        if (!isset($parameter) || !is_numeric($parameter)){
            $message = $parameterName . " must be informed and be a number";
            ResponseHandler::respondWithError($message, 400);
        }
    }
}