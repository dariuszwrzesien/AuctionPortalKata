<?php

namespace FP\Kata;

use DateTime;

class Auction
{
    private $title;
    private $description;
    private $rangeTime;

    public function __construct(string $title, string $description, RangeTime $rangeTime)
    {
        $this->title = $title;
        $this->description = $description;
        $this->rangeTime = $rangeTime;
    }
    
    public function title() : string
    {
        return $this->title;
    }

    public function description() : string
    {
        return $this->description;
    }

    public function startDate() : DateTime
    {
        return $this->rangeTime->startDate();
    }

    public function endDate() : DateTime
    {
        return $this->rangeTime->endDate();
    }
}
