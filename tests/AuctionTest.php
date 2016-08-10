<?php

declare(strict_types=1);

use FP\Kata\Auction;
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
        $auction = new Auction($actual['title'], $actual['description'], $actual['rangeTime'], $actual['user']);
        
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
        $auction = new Auction($actual['title'], $actual['description'], $actual['rangeTime'], $actual['user']);

        $this->assertSame($expected['startDate'], $auction->startDate()->format('Y-m-d'));
        $this->assertSame($expected['endDate'], $auction->endDate()->format('Y-m-d'));
    }

    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider dataProvider
     */
    public function testHasUser($actual, $expected)
    {
        $auction = new Auction($actual['title'], $actual['description'], $actual['rangeTime'], $actual['user']);

        $this->assertInstanceOf($expected['user'], $auction->user());
    }


    public function dataProvider()
    {
        $startDate = '2016-01-01';
        $endDate = '2016-01-02';
        $rageTime = new RangeTime(new DateTime($startDate), new DateTime($endDate));

        $name = 'testUserName';
        $email = 'testUserEmail@futureprocessing.com';
        $user = new User($name, $email);

        return [
            [
                [
                    'title' => 'testTitle',
                    'description' => 'testDescription',
                    'rangeTime' => $rageTime,
                    'user' => $user
                ],
                [
                    'title' => 'testTitle',
                    'description' => 'testDescription',
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'user' => 'FP\Kata\User'
                ]
            ]
        ];
    }
}
