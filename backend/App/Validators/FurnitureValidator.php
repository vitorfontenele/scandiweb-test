<?php

use App\Core\Validator;

class FurnitureValidator extends Validator {
    public function validateSpecialAttributes(object $body) : void {
        $length = $body->length ?? null;
        $height = $body->height ?? null;
        $width = $body->width ?? null;

        $this->validateLength($length);
        $this->validateHeight($height);
        $this->validateWidth($width);
    }

    public function validateLength($length) : void {
        $this->validateRequiredNum($length, "Length");
    }

    public function validateHeight($height) : void {
        $this->validateRequiredNum($height, "Height");
    }

    public function validateWidth($width) : void {
        $this->validateRequiredNum($width, "Width");
    }
}