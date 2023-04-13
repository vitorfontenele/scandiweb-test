<?php

use App\Models\Product;

class Furniture extends Product {
    private float $length;
    private float $height;
    private float $width;

    public function getLength() : float {
        return $this->length;
    }

    public function setLength(float $length) : void {
        $this->length = $length;
    }

    public function getHeight() : float {
        return $this->height;
    }

    public function setHeight(float $height) : void {
        $this->height = $height;
    } 
    
    public function getWidth() : float {
        return $this->width;
    }

    public function setWidth(float $width) : void {
        $this->width = $width;
    }

    public function getSpecialAttributes() : array {
        return ["length" => $this->getLength(),
                "height" => $this->getHeight(),
                "width" => $this->getWidth()];
    }

    public function setSpecialAttributes($input) : void {
        $this->setLength($input->length);
        $this->setHeight($input->height);
        $this->setWidth($input->width);
    }
}