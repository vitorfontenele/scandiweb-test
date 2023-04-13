<?php

use App\Models\Product;

class Dvd extends Product {
    private float $size;

    public function getSize() : int {
        return $this->size;
    }

    public function setSize(int $size) : void {
        $this -> size = $size;
    }

    public function getSpecialAttributes() : array {
        return ["size" => $this->getSize()];
    }

    public function setSpecialAttributes($input) : void {
        $this->setSize($input->size);
    }
}