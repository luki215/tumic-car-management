<?php

namespace Tumic\Modules\Base\Validable;

use Tumic\Lib\Singleton;

abstract class BaseValidator
{
    // returns true if valid, ottherwise error string
    public abstract function validate($value);
}
