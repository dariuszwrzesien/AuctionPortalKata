<?php

namespace FP\Kata;

class Auction
{
    private $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }
    
    public function title() : string
    {
        return $this->title;
    }
}
