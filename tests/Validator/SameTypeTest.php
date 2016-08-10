<?php

declare(strict_types=1);

use FP\Kata\Validator\SameType;
use PHPUnit\Framework\TestCase;

class SameTypeTest extends TestCase
{
    /**
     * @param $actual
     * @param $expected
     *
     * @dataProvider dataProvider
     */
    public function testIfSameType($actual, $expected)
    {
        $sameTypeValidator = new SameType($actual);
        $this->assertSame($expected, $sameTypeValidator->isValid());
    }

    public function dataProvider()
    {
        return [
            [[1, 2], true],
            [[10.1, 0.9], true],
            [['string', 'string'], true],
            [[new stdClass(), new stdClass()], true],
            [[new DateTime(), new DateTime('2016-01-01')], true],
            [[1, '1'], false],
            [[10, 0.9], false],
            [['string', new stdClass('string')], false],
            [[new DateTime(), new stdClass()], false]
        ];
    }
}
