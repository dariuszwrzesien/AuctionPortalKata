<?php

namespace FP\Kata;

use DateTime;

class Auction
{
    private $title;
    private $description;
    private $rangeTime;
    private $price;
    private $owner;

    private $offers = array();

    public function __construct(string $title, string $description, RangeTime $rangeTime, Price $price, User $owner)
    {
        $this->title = $title;
        $this->description = $description;
        $this->rangeTime = $rangeTime;
        $this->price = $price;
        $this->owner = $owner;
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

    public function price() : Price
    {
        return $this->price;
    }

    public function owner() : User
    {
        return $this->owner;
    }

    public function offers() : array
    {
        return $this->offers;
    }

    public function bid(Price $price, User $user)
    {
        $this->offers[] = [$price, $user];

        if ($price->amount() > $this->price->amount()) {
            $this->price = $price;
        }
    }
}
