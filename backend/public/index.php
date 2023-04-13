<?php

require_once("../vendor/autoload.php");

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

header("Content-type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type");

new App\Core\Router();