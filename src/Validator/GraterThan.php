<?php

namespace FP\Kata\Validator;

use InvalidArgumentException;

class GraterThan implements ValidatorInterface
{
    const MESSAGE = 'Value has to be grater than ';

    public static function isValid($value, $minimum) : bool
    {
        if ($value > $minimum) {
            return true;
        }

        throw new InvalidArgumentException(self::MESSAGE . $minimum);
    }
}