<?php

use App\Models\Product;

class Book extends Product {
    private float $weight;

    public function getWeight() : float {
        return $this->weight;
    }

    public function setWeight(float $weight) : void {
        $this->weight = $weight;
    }

    public function getSpecialAttributes() : array {
        return ["weight" => $this->getWeight()];
    }

    public function setSpecialAttributes($input) : void {
        $this->setWeight($input->weight);
    }
}