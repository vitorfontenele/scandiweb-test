<?php

namespace App\Core;

class Database {

    private $connection;

    public function __construct() {
        $host = $_ENV["DB_HOST"];
        $user = $_ENV["USERNAME"];
        $password = $_ENV["PASSWORD"];
        $dbname = $_ENV["DB_NAME"];

        $this->connection = new \PDO("mysql:host=$host;dbname=$dbname;", $user, $password);
    }

    public function getConn() {
        return $this->connection;
    }


    public function database($model)
    {
        $modelToLower = strtolower($model);
        $database = ucfirst($modelToLower) . "Database";
        require_once "../App/Databases/" . $database . ".php";
        return new $database;
    }
}