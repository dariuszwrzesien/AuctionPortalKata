<?php

declare(strict_types=1);

use FP\Kata\Validator\GreaterThan;
use PHPUnit\Framework\TestCase;

class GreaterThanTest extends TestCase
{
    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider dataProvider
     */
    public function testIfGreaterThan($actual, $expected)
    {
        $gtValidator = new GreaterThan($actual['value'], $actual['minimum']);
        $this->assertSame($expected, $gtValidator->isValid());
    }

    public function dataProvider()
    {
        return [
            [['value' =>   1, 'minimum' =>    0], true],
            [['value' =>   1, 'minimum' =>    0], true],
            [['value' =>  -1, 'minimum' =>   -2], true],
            [['value' => 1.1, 'minimum' =>  1.0], true],
            [['value' => 1.1, 'minimum' =>    1], true],
            [['value' =>   0, 'minimum' =>   10], false],
            [['value' =>  -1, 'minimum' =>    0], false],
            [['value' =>   1, 'minimum' =>    1], false],
            [['value' =>   0, 'minimum' =>    0], false],

            [['value' => new DateTime('2020-01-01'), 'minimum' => new DateTime()], true],
            [['value' => new DateTime('2016-01-01'), 'minimum' => new DateTime('2016-01-01')], false],
        ];
    }
}
