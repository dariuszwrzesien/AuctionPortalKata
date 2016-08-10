<?php

namespace FP\Kata;

use FP\Kata\Validator\GreaterThan;

class Price
{
    const UNIT = 100;
    const MINIMAL_AMOUNT = 0;
    const DEFAULT_FRACTION = 2;

    private $amount;

    public function __construct(int $amount)
    {
        $gtValidator = new GreaterThan($amount,  self::MINIMAL_AMOUNT);

        if ($gtValidator->isValid()) {
            $this->amount = $amount;
        }
    }
    
    public function amount() : float
    {
        return round($this->amount/self::UNIT , self::DEFAULT_FRACTION);
    }
}
