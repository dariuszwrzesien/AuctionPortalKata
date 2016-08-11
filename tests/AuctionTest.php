<?php

declare(strict_types=1);

use FP\Kata\Auction;
use FP\Kata\Price;
use FP\Kata\RangeTime;
use FP\Kata\User;
use PHPUnit\Framework\TestCase;

class AuctionTest extends TestCase
{
    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider dataProvider
     */
    public function testHasTitleAndDescription($actual, $expected)
    {
        $auction = new Auction(
            $actual['title'],
            $actual['description'],
            $actual['rangeTime'],
            $actual['price'],
            $actual['owner']
        );
        
        $this->assertSame($expected['title'], $auction->title());
        $this->assertSame($expected['description'], $auction->description());
    }

    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider dataProvider
     */
    public function testHasStartAndEndDate($actual, $expected)
    {
        $auction = new Auction(
            $actual['title'],
            $actual['description'],
            $actual['rangeTime'],
            $actual['price'],
            $actual['owner']
        );

        $this->assertSame($expected['startDate'], $auction->startDate()->format('Y-m-d'));
        $this->assertSame($expected['endDate'], $auction->endDate()->format('Y-m-d'));
    }

    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider dataProvider
     */
    public function testHasInstanceOfPrice($actual, $expected)
    {
        $auction = new Auction(
            $actual['title'],
            $actual['description'],
            $actual['rangeTime'],
            $actual['price'],
            $actual['owner']
        );

        $this->assertInstanceOf($expected['priceClass'], $auction->price());
    }

    public function testIfPriceIsReturnedCorrectly()
    {
        $regularPrice = 10.99;
        $centsPrice = (int)($regularPrice * 100);

        $auction = new Auction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-02')),
            new Price($centsPrice),
            new User('testUserName', 'testUserEmail@future-processing.com')
        );

        $this->assertSame($regularPrice, $auction->price()->amount());
    }

    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider dataProvider
     */
    public function testHasInstanceOfUserAsOwner($actual, $expected)
    {
        $auction = new Auction(
            $actual['title'],
            $actual['description'],
            $actual['rangeTime'],
            $actual['price'],
            $actual['owner']
        );

        $this->assertInstanceOf($expected['owner'], $auction->owner());
    }

    public function testBidOfferAndCountAfterBid()
    {
        $price = 9.99;
        $centsPrice = (int)($price * 100);

        $user = new User('testNickname', 'test@future-processing.com');

        $auction = new Auction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-02')),
            new Price($centsPrice),
            new User('testUserName', 'testUserEmail@future-processing.com')
        );

        $newPrice = 10.99;
        $newCentsPrice = (int)($newPrice * 100);

        $auction->bid(new Price($newCentsPrice), $user);
        $this->assertSame($newPrice, $auction->price()->amount());

        $newPrice = 100.99;
        $newCentsPrice = (int)($newPrice * 100);

        $auction->bid(new Price($newCentsPrice), $user);
        $this->assertSame($newPrice, $auction->price()->amount());

        $newPrice = 999.99;
        $newCentsPrice = (int)($newPrice * 100);

        $auction->bid(new Price($newCentsPrice), $user);
        $this->assertSame($newPrice, $auction->price()->amount());

        $this->assertCount(3, $auction->offers());
    }

    public function dataProvider()
    {
        $startDate = '2016-01-01';
        $endDate = '2016-01-02';
        $rageTime = new RangeTime(new DateTime($startDate), new DateTime($endDate));

        $centsPrice = (int)(10.99 * 100);
        $price = new Price($centsPrice);

        $nickname = 'testUserName';
        $email = 'testUserEmail@future-processing.com';
        $owner = new User($nickname, $email);

        return [
            [
                [
                    'title' => 'testTitle',
                    'description' => 'testDescription',
                    'rangeTime' => $rageTime,
                    'price' => $price,
                    'owner' => $owner
                ],
                [
                    'title' => 'testTitle',
                    'description' => 'testDescription',
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'price' => $price,
                    'priceClass' => 'FP\Kata\Price',
                    'owner' => 'FP\Kata\User'
                ]
            ]
        ];
    }
}
