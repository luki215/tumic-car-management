<?php

namespace Tumic\Modules\Base\Validable;

trait Validable
{
    private $validators = [];
    public $errors = [];

    public function setValidators($property, BaseValidator ...$validators)
    {
        foreach ($validators as $validator) {
            $this->validators[$property][] = $validator;
        }
    }

    public function validate()
    {
        $this->errors = [];
        foreach ($this->validators as $key => $keyValidators) {
            foreach ($keyValidators as $keyValidator) {
                $res = $keyValidator->validate($this->$key);
                if ($res !== true) {
                    $this->errors[$key] = $res;
                }
            }
        }
        return count($this->errors) === 0;
    }
}
