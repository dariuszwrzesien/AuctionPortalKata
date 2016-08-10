<?php

namespace FP\Kata;

use FP\Kata\Validator\GraterThan;

class Price
{
    const UNIT = 100;
    const MINIMAL_AMOUNT = 0;
    const DEFAULT_FRACTION = 2;

    private $amount;

    public function __construct(int $amount)
    {
        if (GraterThan::isValid($amount, self::MINIMAL_AMOUNT)) {
            $this->amount = $amount;
        }
    }
    
    public function amount() : float
    {
        return round($this->amount/self::UNIT , self::DEFAULT_FRACTION);
    }
}
