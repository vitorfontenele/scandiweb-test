<?php

use App\Core\Validator;

class DvdValidator extends Validator {
    public function validateSpecialAttributes(object $body) : void {
        $size = $body -> size ?? null;

        $this->validateSize($size);
    }

    public function validateSize($size) : void {
        $this->validateRequiredNum($size, "Size");
    }
}