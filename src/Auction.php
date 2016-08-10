<?php

namespace FP\Kata;

use DateTime;

class Auction
{
    private $title;
    private $description;
    private $rangeTime;
    private $user;

    public function __construct(string $title, string $description, RangeTime $rangeTime, User $user)
    {
        $this->title = $title;
        $this->description = $description;
        $this->rangeTime = $rangeTime;
        $this->user = $user;
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

    public function user() : User
    {
        return $this->user;
    }


}
