<?php

declare(strict_types=1);

use DateTime;
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
