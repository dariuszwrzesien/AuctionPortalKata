<?php

declare(strict_types=1);

use FP\Kata\Auction;
use FP\Kata\Price;
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
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-02')),
            new Price(888)
        );
        $user->createAuction(
            'testTitle2',
            'testDescription2',
            new RangeTime(new DateTime('2016-01-02'), new DateTime('2016-01-03')),
            new Price(999)
        );
        $user->createAuction(
            'testTitle3',
            'testDescription3',
            new RangeTime(new DateTime('2016-01-03'), new DateTime('2016-01-04')),
            new Price(1099)
        );

        $this->assertCount(3, $user->auctions());
    }

    public function testCreateAuction()
    {
        $user = new User('DariuszWrzesien', 'dwrzesien@future-processing.com');

        $user->createAuction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-02')),
            new Price(1099)
        );

        $auctions = $user->auctions();
        $this->assertInstanceOf('FP\Kata\Auction', $auctions[0]);
    }

    public function testCreateOffer()
    {
        $user = new User('DariuszWrzesien', 'dwrzesien@future-processing.com');

        $price = 7.77;
        $centsPrice = (int)($price * 100);

        $auction = new Auction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-03')),
            new Price($centsPrice),
            new User('Owner1', 'owner1@future-processing.com')
        );

        $user->createOffer(
            $auction,
            new Price($centsPrice + 100)
        );

        $this->assertCount(1, $auction->offers());
        $this->assertSame($price + 1, $auction->price()->amount());

        $user->createOffer(
            $auction,
            new Price($centsPrice + 200)
        );

        $this->assertCount(2, $auction->offers());
        $this->assertSame($price + 2, $auction->price()->amount());

        $user->createOffer(
            $auction,
            new Price($centsPrice + 300)
        );

        $this->assertCount(3, $auction->offers());
        $this->assertSame($price + 3, $auction->price()->amount());

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
