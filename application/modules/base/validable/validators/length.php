<?php

namespace Tumic\Modules\Base\Validable\Validators;

use Tumic\Modules\Base\Validable\BaseValidator;

class Length extends BaseValidator
{
    private $length;
    public function __construct($length)
    {
        $this->length = $length;
    }
    public function validate($value)
    {
        $valid = (new Required())->validate($value) === true && strlen($value) === $this->length;
        return $valid ? true : "Musí být dlouhé " . $this->length . " znaků";
    }
}
