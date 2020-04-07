<?php

namespace Tumic\Modules\Base\Validable\Validators;

use Tumic\Modules\Base\Validable\BaseValidator;

class Date extends BaseValidator
{
    public function validate($value)
    {
        $valid = preg_match('/[0-9]{2}\.[0-9]{2}\.[0-9]{4}/', $value) === 1;
        return $valid ? true : "Datum musí být ve formátu dd.mm.rrrr";
    }
}
