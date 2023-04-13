<?php

use App\Core\Validator;

class BookValidator extends Validator {
    public function validateSpecialAttributes(object $body) : void {
        $weight = $body->weight ?? null;
  
        $this->validateWeight($weight);
    }

    public function validateWeight($weight) : void {
      $this->validateRequiredNum($weight, "Weight");
    }     
}