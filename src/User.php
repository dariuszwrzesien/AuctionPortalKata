<?php

namespace FP\Kata;

class User
{
    private $nickname;
    private $email;
    private $auctions;

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

    public function createAuction(string $title, string $description, RangeTime $rangeTime)
    {
        $this->auctions[] = new Auction($title, $description, $rangeTime, $this);
    }
}
