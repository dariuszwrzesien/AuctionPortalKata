<?php

namespace FP\Kata;

class User
{
    private $nickname;
    private $email;
    
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
}
