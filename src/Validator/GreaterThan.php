<?php

namespace FP\Kata\Validator;

class GreaterThan extends AbstractValidator
{
    const ERROR_MESSAGE = 'Value has to be greater than minimum value';

    private $value;
    private $minValue;

    public function __construct($value, $minValue)
    {
        $this->value = $value;
        $this->minValue = $minValue;
    }

    public function isValid() : bool
    {
        if ($this->value > $this->minValue) {
            return true;
        }

        $this->error = self::ERROR_MESSAGE;
        return false;
    }
}