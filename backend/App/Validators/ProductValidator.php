<?php

namespace App\Validators;
use App\Core\Validator;
use App\Core\ResponseHandler;

class ProductValidator extends Validator {
    public function validateAttributes(object $body) : void {
      $sku = $body->sku ?? null;
      $name = $body->name ?? null;
      $price = $body->price ?? null;
      $type = $body->type ?? null;

      $this->validateSku($sku);
      $this->validateName($name);
      $this->validatePrice($price);
      $this->validateType($type);
    }

    public function validateSku($sku) : void
    {
      $this->validateRequiredStr($sku, "Sku");
    }

    public function validateName($name) : void
    {
      $this->validateRequiredStr($name, "Name");
    }

    public function validatePrice($price) : void
    {
      $this->validateRequiredNum($price, "Price");
    }

    public function validateType($type) : void
    {
      $this->validateRequiredStr($type, "Type");

      $typeToLower = strtolower($type);
      $modelTypePath = "../App/Databases/" . ucfirst($typeToLower) . "Database.php";
      if (!file_exists($modelTypePath)){
        ResponseHandler::respondWithError("Invalid type (must be book, dvd or furniture)", 400);
      }
    }
}