<?php

namespace FP\Kata;

class User
{
    private $nickname;
    
    public function __construct(string $nickname)
    {
        $this->nickname = $nickname;
    }
    
    public function nickname() : string
    {
        return $this->nickname;
    }
}