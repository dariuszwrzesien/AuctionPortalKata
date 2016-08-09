<?php

declare(strict_types=1);

use FP\Kata\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider dataProvider
     */
    public function testHasNicknameAndEmail($actual, $expected)
    {
        $user = new User($actual['nickname'], $actual['email']);
        
        $this->assertSame($expected['nickname'], $user->nickname());
        $this->assertSame($expected['email'], $user->email());
    }

    public function dataProvider()
    {
        return [
            [
                ['nickname' => 'AdrianPietka', 'email' => 'apietka@futureprocessing.com'],
                ['nickname' => 'AdrianPietka', 'email' => 'apietka@futureprocessing.com']
            ],
            [
                ['nickname' => 'DariuszWrzesien', 'email' => 'dwrzesien@futureprocessing.com'],
                ['nickname' => 'DariuszWrzesien', 'email' => 'dwrzesien@futureprocessing.com']
            ]
        ];
    }
}
