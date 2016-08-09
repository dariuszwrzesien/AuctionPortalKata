<?php

namespace FP\Kata;

use InvalidArgumentException;

class Price
{
    const UNIT = 100;
    const MINIMAL_AMOUNT = 0;
    const DEFAULT_FRACTION = 2;

    private $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }
    
    public function amount() : float
    {
        return round($this->amount/self::UNIT , self::DEFAULT_FRACTION);
    }

    public function isValid(int $amount)
    {
        if ($amount > self::MINIMAL_AMOUNT) {
            return true;
        }

        throw new InvalidArgumentException('Price should be grater than ' . self::MINIMAL_AMOUNT);
    }
}
