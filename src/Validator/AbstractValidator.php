<?php

namespace FP\Kata\Validator;

abstract class AbstractValidator
{
    protected $error;

    abstract public function isValid() : bool;

    public function error() : string
    {
        return $this->error ? $this->error : [];
    }
}
