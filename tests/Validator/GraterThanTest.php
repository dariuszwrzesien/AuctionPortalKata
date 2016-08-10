<?php

declare(strict_types=1);

use FP\Kata\Validator\GraterThan;
use PHPUnit\Framework\TestCase;

class GraterThanTest extends TestCase
{
    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider dataProvider
     */
    public function testIfGraterThan($actual,$expected)
    {
        $this->assertSame($expected, GraterThan::isValid($actual['value'], $actual['minimum']));
    }

    /**
     * @param $actual
     *
     * @expectedException InvalidArgumentException
     *
     * @dataProvider exceptionDataProvider
     */
    public function testIfPriceEqualsMinimumAmountThenThrowException($actual)
    {
        GraterThan::isValid($actual['value'], $actual['minimum']);
    }

    public function dataProvider()
    {
        return [
            [['value' => 1, 'minimum' => 0], true],
            [['value' => 1, 'minimum' => 0], true],
        ];
    }

    public function exceptionDataProvider()
    {
        return [
            [['value' => 0, 'minimum' => 10]],
            [['value' => -1, 'minimum' => 0]],
        ];
    }
}
