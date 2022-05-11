<?php

namespace OrderBundle\Validators\Test;

use OrderBundle\Validators\CreditCardNumberValidator;
use PHPUnit\Framework\TestCase;

class CreditCardNumberValitadorTest extends TestCase
{
    /**
     * @dataProvider valueProvider
     * @param $value
     * @param $expectedResult
     * @return void
     */
    public function testIsValid($value, $expectedResult): void
    {
        $creditCardNumberValidator = new CreditCardNumberValidator($value);

        $isValid = $creditCardNumberValidator->isValid();

        $this->assertEquals($expectedResult, $isValid);
    }

    /**
     * @return array
     */
    public function valueProvider(): array
    {
        return [
            'shouldBeValidWhenIsACreditCard' => ['value' => 4928148506666302, 'expectedResult' => true],
            'shouldBeValidWhenIsACreditCardAsString' => ['value' => '4928148506666302', 'expectedResult' => true],
            'shouldNotBeValidWhenIsNotACreditCard' => ['value' => '12738', 'expectedResult' => false],
            'shouldNotBeValidWhenIsEmpty' => ['value' => '', 'expectedResult' => false],
        ];
    }
}
