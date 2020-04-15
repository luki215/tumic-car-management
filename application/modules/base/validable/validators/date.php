<?php

namespace Tumic\Modules\Base\Validable\Validators;

use Tumic\Modules\Base\Validable\BaseValidator;

class Date extends BaseValidator
{
    private $min;
    public function __construct($min = null)
    {
        $this->min = $min;
    }

    public function validate($value)
    {
        $valid = preg_match('/[0-9]{2}\.[0-9]{2}\.[0-9]{4}/', $value) === 1;
        if (!$valid) {
            return "Datum musí být ve formátu dd.mm.rrrr";
        }

        $date = strtotime($value);
        if (isset($this->min) && $date < $this->min) {
            return "Musí být později než " .  date('d.m.Y', $this->min);
        }
        return true;
    }
}
