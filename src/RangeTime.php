<?php

namespace FP\Kata;

use DateTime;

class RangeTime
{
    private $startDate;
    private $endDate;
    
    public function __construct(DateTime $startDate, DateTime $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    public function startDate() : DateTime
    {
        return $this->startDate;
    }

    public function endDate() : DateTime
    {
        return $this->endDate;
    }
}
