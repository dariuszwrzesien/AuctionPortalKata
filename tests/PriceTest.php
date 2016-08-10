<?php

declare(strict_types=1);

use FP\Kata\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider dataProvider
     */
    public function testHasPrice($actual, $expected)
    {
        $priceAmount = (int)($actual * 100);
        $price = new Price($priceAmount);
        
        $this->assertSame($expected, $price->amount());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Value has to be grater than 0
     */
    public function testIfPriceEqualsMinimumAmountThenThrowException()
    {
        new Price(Price::MINIMAL_AMOUNT);
    }

    public function dataProvider()
    {
        return [
            [1024.55, 1024.55],
            [10.55, 10.55],
            [10.5, 10.50],
            [0.01, 0.01],
            [0.1, 0.10],
            [10, 10.00],
            [2, 2.00],
        ];
    }
}
