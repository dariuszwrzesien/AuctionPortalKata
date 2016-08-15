<?php

namespace FP\Kata;

use DateTime;
use InvalidArgumentException;
use FP\Kata\Validator\GreaterThan;

class RangeTime
{
    private $startDate;
    private $endDate;

    public function __construct(DateTime $startDate, DateTime $endDate)
    {
        $greaterThan = new GreaterThan($endDate, $startDate);

        if ($greaterThan->isValid()) {
            $this->startDate = $startDate;
            $this->endDate = $endDate;
        } else {
            throw new InvalidArgumentException($greaterThan->error());
        }
    }
    
    public function startDate() : DateTime
    {
        return $this->startDate;
    }

    public function endDate() : DateTime
    {
        return $this->endDate;
    }

    public function isBetween(DateTime $date) : bool
    {
        if ($date >= $this->startDate && $date <= $this->endDate) {
            return true;
        }

        return false;
    }
}
