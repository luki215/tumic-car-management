<?php

namespace Tumic\Modules\Base\Validable\Validators;

use Tumic\Modules\Base\Validable\BaseValidator;

class Required extends BaseValidator
{
    public function validate($value)
    {
        return isset($value) && $value !== null && $value !== "" ? true : "Toto pole je povinné";
    }
}
