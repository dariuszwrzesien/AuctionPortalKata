<?php

namespace FP\Kata;

use DateTime;
use InvalidArgumentException;
use FP\Kata\Validator\GreaterThan;

class Auction
{
    const ACTIVE = true;
    const FINISHED = false;

    const MINIMAL_AMOUNT_DIFF = 1.00;

    private $title;
    private $description;
    private $rangeTime;
    private $price;
    private $owner;
    private $buyNowPrice;
    private $status;

    private $offers = array();
    private $winner;

    public function __construct(
        string $title,
        string $description,
        RangeTime $rangeTime,
        Price $price,
        User $owner,
        Price $buyNowPrice = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->rangeTime = $rangeTime;
        $this->price = $price;
        $this->owner = $owner;

        if ($buyNowPrice) {
            $this->buyNowPrice = $this->setBuyNowPrice($buyNowPrice);
        }

        $this->status = self::ACTIVE;
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

    public function bid(Price $price, User $user) : bool
    {
        $greaterThan = new GreaterThan($price->amount(), $this->price()->amount() + self::MINIMAL_AMOUNT_DIFF);

        if ($greaterThan->isValid(GreaterThan::AND_EQUAL)) {
            $this->offers[] = [$price, $user];
            $this->price = $price;
            return true;
        }
        return false;
    }

    public function buyNowPrice() : Price
    {
        return $this->buyNowPrice;
    }

    public function buyNow(User $user)
    {
        $this->winner = $user;
        $this->status = self::FINISHED;
        $user->addArticle($this);
    }

    public function isActive() : bool
    {
        if ($this->isExpired(new DateTime())) {
            $this->status = false;
        }

        return $this->status;
    }

    private function setBuyNowPrice(Price $buyNowPrice)
    {
        $greaterThan = new GreaterThan($buyNowPrice->amount(), $this->price()->amount());

        if ($greaterThan->isValid()) {
            return $buyNowPrice;
        } else {
            throw new InvalidArgumentException($greaterThan->error());
        }
    }

    public function isExpired(DateTime $today) : bool
    {
        return ! $this->rangeTime->isBetween($today);
    }
}
