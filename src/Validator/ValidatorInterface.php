<?php

namespace FP\Kata\Validator;

interface ValidatorInterface
{
    public static function isValid($value, $minimum) : bool;
}
