<?php

namespace FP\Kata;

use InvalidArgumentException;
use FP\Kata\Validator\GreaterThan;

class Price
{
    const UNIT = 100;
    const MINIMAL_AMOUNT = 0;
    const DEFAULT_FRACTION = 2;

    private $amount;

    public function __construct(int $amount)
    {
        $greaterThan = new GreaterThan($amount, self::MINIMAL_AMOUNT);

        if ($greaterThan->isValid()) {
            $this->amount = $amount;
        } else {
            throw new InvalidArgumentException($greaterThan->error());
        }
    }
    
    public function amount() : float
    {
        return round($this->amount/self::UNIT , self::DEFAULT_FRACTION);
    }
}
