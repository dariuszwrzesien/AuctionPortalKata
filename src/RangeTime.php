<?php

namespace FP\Kata;

use DateTime;
use InvalidArgumentException;

class RangeTime
{
    private $startDate;
    private $endDate;
    
    public function __construct(DateTime $startDate, DateTime $endDate)
    {
        if ($this->isValid($startDate, $endDate)) {
            $this->startDate = $startDate;
            $this->endDate = $endDate;
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

    private function isValid(DateTime $startDate, DateTime $endDate) : bool
    {
        if($startDate < $endDate) {
            return true;
        }

        throw new InvalidArgumentException('Start date should be grater than end date');
    }
}
