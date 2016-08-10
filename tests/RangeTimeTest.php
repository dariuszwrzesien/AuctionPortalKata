<?php

declare(strict_types=1);

use FP\Kata\RangeTime;
use PHPUnit\Framework\TestCase;

class RangeTimeTest extends TestCase
{
    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider dataProvider
     */
    public function testHasStartDateAndEndDate($actual, $expected)
    {
        $rangeTime = new RangeTime(new DateTime($actual['startDate']), new DateTime($actual['endDate']));
        
        $this->assertSame($expected['startDate'], $rangeTime->startDate()->format('Y-m-d'));
        $this->assertSame($expected['endDate'], $rangeTime->endDate()->format('Y-m-d'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Start date should be grater than end date
     */
    public function testIfStartDateGreaterThenEndDateThenThrowsException()
    {
        new RangeTime(new DateTime('2016-01-02'), new DateTime('1999-01-01'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Start date should be grater than end date
     */
    public function testIfStartDateEqualsEndDateThenThrowsException()
    {
        new RangeTime(new DateTime('2016-01-01'), new DateTime('2016-01-01'));
    }

    public function dataProvider()
    {
        return [
            [
                ['startDate' => '2016-01-01', 'endDate' => '2016-01-02'],
                ['startDate' => '2016-01-01', 'endDate' => '2016-01-02']
            ]
        ];
    }
}
