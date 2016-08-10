<?php

declare(strict_types=1);

use FP\Kata\User;
use FP\Kata\RangeTime;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider userProvider
     */
    public function testHasNicknameAndEmail($actual, $expected)
    {
        $user = new User($actual['nickname'], $actual['email']);
        
        $this->assertSame($expected['nickname'], $user->nickname());
        $this->assertSame($expected['email'], $user->email());
    }


    public function testCountAuction()
    {
        $user = new User('DariuszWrzesien', 'dwrzesien@future-processing.com');
        $user->createAuction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-02'))
        );
        $user->createAuction(
            'testTitle2',
            'testDescription2',
            new RangeTime(new DateTime('2016-01-02'), new DateTime('2016-01-03'))
        );
        $user->createAuction(
            'testTitle3',
            'testDescription3',
            new RangeTime(new DateTime('2016-01-03'), new DateTime('2016-01-04'))
        );

        $this->assertCount(3, $user->auctions());
    }

    public function testCreateAuction()
    {
        $user = new User('DariuszWrzesien', 'dwrzesien@future-processing.com');

        $user->createAuction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-02'))
        );

        $auctions = $user->auctions();
        $this->assertInstanceOf('FP\Kata\Auction', $auctions[0]);
    }

    public function userProvider()
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
