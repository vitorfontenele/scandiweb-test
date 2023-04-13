<?php

namespace App\Core;

class Router {
    private $uriFirstPar;
    private $uriSecondPar;
    private $uriThirdPar;
    private $method;
    private $controllerClassname;
    private $controllerInstance;
    private $controllerMethod;
    private $params = [];

    function __construct(){
        list($this->uriFirstPar, $this->uriSecondPar, $this->uriThirdPar, $this->method, $this->controllerClassname) = $this->parseURL();
        $this->analyzeControllerPath();
        $this->setControllerInstance();
        $this->dispatch();
    }

    private function parseURL() : array {
        $uri = explode("/", $_SERVER["REQUEST_URI"]);
        $uriFirstPar = $uri[2] ?? null;
        $uriSecondPar = $uri[3] ?? null;
        $uriThirdPar = $uri[4] ?? null;
        $method = $_SERVER["REQUEST_METHOD"];
        $controllerClassname = ucfirst($uriFirstPar ?? "Default") . "Controller";

        return [$uriFirstPar, $uriSecondPar, $uriThirdPar, $method, $controllerClassname];
    }

    private function analyzeControllerPath() : void {
        $controllerPath = "../App/Controllers/" . $this->controllerClassname . ".php";
        if (!file_exists($controllerPath)){
            ResponseHandler::respondWithError("Resource not found", 404);
        }
    }

    private function setControllerInstance() : void {
        require_once "../App/Controllers/" . $this->controllerClassname . ".php";
        $controllerClassname = $this->controllerClassname;
        $this->controllerInstance = new $controllerClassname;
    }

    private function dispatch() : void {
        switch($this->method){
            case "GET":
                if (isset($this->uriSecondPar) && $this->uriSecondPar !== ""){
                    ResponseHandler::respondWithError("Resource not found", 404);
                } 
                $this->controllerMethod = "index";
                break;
            case "POST":
                if (isset($this->uriThirdPar) && $this->uriThirdPar !== ""){
                    ResponseHandler::respondWithError("Resource not found", 404);
                } else if (isset($this->uriSecondPar) && $this->uriSecondPar !== "deletemany" && $this->uriSecondPar !== "") {
                    ResponseHandler::respondWithError("Resource not found", 404);
                } else if (isset($this->uriSecondPar) && $this->uriSecondPar === "deletemany"){
                    $this->controllerMethod = "deleteMany";
                } else if (!isset($this->uriSecondPar) || $this->uriSecondPar === ""){
                    $this->controllerMethod = "store";
                }
                break;
            case "DELETE":
                if (isset($this->uriThirdPar) && $this->uriThirdPar !== ""){
                    ResponseHandler::respondWithError("Resource not found", 404);
                } else if (isset($this->uriSecondPar)){
                    $this->params = [$this->uriSecondPar];
                    $this->controllerMethod = "delete";
                } else {
                    ResponseHandler::respondWithError("Resource not found", 404);
                }
                break;
            case "OPTIONS":
                ResponseHandler::respondWithSuccess(null, null);
            default:
                ResponseHandler::respondWithError("Method not allowed", 405);
        }

        call_user_func_array([$this->controllerInstance, $this->controllerMethod], $this->params);
    }
}