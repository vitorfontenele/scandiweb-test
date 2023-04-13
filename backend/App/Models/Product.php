<?php

namespace App\Models;

abstract class Product {
    private string $name;
    private float $price;
    private string $sku;
    private string $type;

    public function setName(string $name) : void {
      $this->name = $name;
    }

    public function getName() : string {
      return $this->name;
    }

    public function setPrice(float $price) : void {
      $this->price = $price;
    }

    public function getPrice() : float {
      return $this->price;
    }

    public function setSku(string $sku) : void {
      $this->sku = $sku;
    }

    public function getSku() : string {
      return $this->sku;
    }

    public function setType(string $type) : void {
      $this->type = $type;
    }

    public function getType() : string {
      return $this->type;
    }

    public function getAttributes() : array {
      return [
        "sku" => $this->getSku(),
        "name" => $this->getName(),
        "price" => $this->getPrice(),
        "type" => $this->getType()
      ];
    }

    public function setAttributes($input) : void {
      $this->setSku($input->sku);
      $this->setName($input->name);
      $this->setPrice($input->price);
      $this->setType($input->type);
    }
}