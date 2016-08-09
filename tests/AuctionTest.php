<?php

declare(strict_types=1);

use FP\Kata\Auction;
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
        $auction = new Auction($actual['title'], $actual['description']);
        
        $this->assertSame($expected['title'], $auction->title());
        $this->assertSame($expected['description'], $auction->description());
    }

    public function dataProvider()
    {
        return [
            [
                ['title' => 'testTitle', 'description' => 'testDescription'],
                ['title' => 'testTitle', 'description' => 'testDescription']
            ]
        ];
    }
}
