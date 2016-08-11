<?php

namespace FP\Kata;

class User
{
    private $nickname;
    private $email;
    private $auctions = array();

    public function __construct(string $nickname, string $email)
    {
        $this->nickname = $nickname;
        $this->email = $email;
    }
    
    public function nickname() : string
    {
        return $this->nickname;
    }

    public function email() : string
    {
        return $this->email;
    }

    public function auctions() : array
    {
        return $this->auctions;
    }

    public function createAuction(string $title, string $description, RangeTime $rangeTime, Price $price)
    {
        $this->auctions[] = new Auction(
            $title,
            $description,
            $rangeTime,
            $price,
            $this
        );
    }

    public function createOffer(Auction $auction, Price $price)
    {
        $auction->bid($price, $this);
    }
}
