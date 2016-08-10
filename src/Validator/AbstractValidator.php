<?php

namespace FP\Kata\Validator;

abstract class AbstractValidator
{
    protected $errors;

    abstract public function isValid() : bool;

    public function errors() : array
    {
        return is_array($this->errors) ? $this->errors : [];
    }
}
