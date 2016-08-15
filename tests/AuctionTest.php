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

    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider priceProvider
     */
    public function testBidOffer($actual, $expected)
    {
        $user = new User('testNickname', 'test@future-processing.com');

        $auction = new Auction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-02')),
            new Price($actual['regularCentsPrice']),
            new User('testUserName', 'testUserEmail@future-processing.com')
        );

        $auction->bid(new Price($actual['newCentsPrice']), $user);
        $this->assertSame($expected['price'], $auction->price()->amount());
    }

    public function testCountBiddenOffer()
    {
        $user = new User('testNickname', 'test@future-processing.com');

        $auction = new Auction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-02')),
            new Price(99),
            new User('testUserName', 'testUserEmail@future-processing.com')
        );

        $auction->bid(new Price(199), $user);
        $auction->bid(new Price(299), $user);
        $auction->bid(new Price(399), $user);

        $this->assertCount(3, $auction->offers());
    }

    public function testBidIsOneOrMoreEurosHigherThanCurrentPrice()
    {
        $user = new User('testNickname', 'test@future-processing.com');

        $auction = new Auction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-02')),
            new Price(100),
            new User('testUserName', 'testUserEmail@future-processing.com')
        );

        $this->assertTrue($user->createOffer($auction, new Price(200)));
        $this->assertTrue($user->createOffer($auction, new Price(350)));
        $this->assertFalse($user->createOffer($auction, new Price(300)));
    }

    public function testBuyNowPriceHasToBeHigherThanStartingPrice()
    {
        $buyNowPrice = 1.50;
        $buyNowCentsPrice = (int)($buyNowPrice * 100);

        $auction = new Auction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-02')),
            new Price(100),
            new User('testUserName', 'testUserEmail@future-processing.com'),
            new Price($buyNowCentsPrice)
        );

        $this->assertSame($buyNowPrice, $auction->buyNowPrice()->amount());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Value has to be greater than minimum value
     */
    public function testSetLowerBuyNowPriceThanStartingPriceReturnsException()
    {
        $buyNowPrice = 0.50;
        $buyNowCentsPrice = (int)($buyNowPrice * 100);

        new Auction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-02')),
            new Price(100),
            new User('testUserName', 'testUserEmail@future-processing.com'),
            new Price($buyNowCentsPrice)
        );
    }

    public function testBuyNowFinishesAuction()
    {
        $auction = new Auction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime()),
            new Price(100),
            new User('testUserName', 'testUserEmail@future-processing.com'),
            new Price(101)
        );

        $this->assertTrue($auction->isActive());

        $auction->buyNow(new User('testNickname', 'test@future-processing.com'));
        $this->assertFalse($auction->isActive());
    }

    public function testIsExpiredAuction()
    {
        $auction = new Auction(
            'testTitle',
            'testDescription',
            new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-05')),
            new Price(100),
            new User('testUserName', 'testUserEmail@future-processing.com'),
            new Price(101)
        );

        $this->assertFalse($auction->isExpired(new DateTime('2016-01-01')));
        $this->assertFalse($auction->isExpired(new DateTime('2016-01-03')));
        $this->assertFalse($auction->isExpired(new DateTime('2016-01-05')));
        $this->assertTrue($auction->isExpired(new DateTime('2015-12-31')));
        $this->assertTrue($auction->isExpired(new DateTime('2016-01-06')));
    }

    public function dataProvider()
    {
        $now = new DateTime();

        $startDate = '2016-01-01';
        $endDate = $now->format('Y-m-d');
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

    public function priceProvider()
    {
        return [
            [
                ['regularPrice' => 1, 'regularCentsPrice' => 100, 'newPrice' => 2, 'newCentsPrice' => 200],
                ['price' => 2.0, 'centsPrice' => 200, 'validation' => true]
            ],
            [
                ['regularPrice' => 0.99, 'regularCentsPrice' => 99, 'newPrice' => 1.99, 'newCentsPrice' => 199],
                ['price' => 1.99, 'centsPrice' => 199, 'validation' => true]
            ],
            [
                ['regularPrice' => 10.99, 'regularCentsPrice' => 1099, 'newPrice' => 11.99, 'newCentsPrice' => 1199],
                ['price' => 11.99, 'centsPrice' => 1199, 'validation' => true]
            ]
        ];
    }
}
