<?php

namespace OrderBundle\Validators\Test;

use OrderBundle\Validators\NumericValidator;
use PHPUnit\Framework\TestCase;

class NumericValidatorTest extends TestCase
{
    /**
     * @dataProvider valueProvider
     * @param $value
     * @param $expectedResult
     * @return void
     */
    public function testIsValid($value, $expectedResult)
    {
        $numericValidator = new NumericValidator($value);

        $isValid = $numericValidator->isValid();

        $this->assertEquals($expectedResult, $isValid);
    }

    public function valueProvider(): array
    {
        return [
            'shouldBeValidWhenValueIsNumber' => ['value' => 20, 'expectedResult' => true],
            'shouldBeValidWhenValueIsANumericString' => ['value' => '20', 'expectedResult' => true],
            'shouldNotBeValueWhenValueIsNotNumber' => ['value' => 'bla', 'expectedResult' => false],
            'shouldNotBeValidWhenValueIsEmpty' => ['value' => '', 'expectedResult' => false],
        ];
    }

}
