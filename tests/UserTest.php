<?php

declare(strict_types=1);

use FP\Kata\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testHasNickname()
    {
        $nickname = 'AdrianPietka';
        $user = new User($nickname);
        
        $this->assertSame($nickname, $user->nickname());
    }
}