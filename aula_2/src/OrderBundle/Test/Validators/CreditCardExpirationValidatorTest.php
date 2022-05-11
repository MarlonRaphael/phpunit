<?php

namespace OrderBundle\Validators\Test;

use Exception;
use OrderBundle\Validators\CreditCardExpirationValidator;
use PHPUnit\Framework\TestCase;

class CreditCardExpirationValidatorTest extends TestCase
{
    /**
     * @dataProvider valueProvider
     * @param $value
     * @param $expectedResult
     * @return void
     * @throws Exception
     */
    public function testIsValid($value, $expectedResult)
    {
        $creditCardExpirationDate = new \DateTime($value);
        $creditCardExpirationValidatorTest = new CreditCardExpirationValidator($creditCardExpirationDate);

        $isValid = $creditCardExpirationValidatorTest->isValid();

        $this->assertEquals($expectedResult, $isValid);
    }

    /**
     * @return array[]
     */
    public function valueProvider(): array
    {
        return [
            'shouldBeValidWhenDateIsNotExpired' => ['value' => '2025-01-01', 'expectedResult' => true],
            'shouldNotBeValidWhenDateIsExpired' => ['value' => '2021-01-01', 'expectedResult' => false],
        ];
    }
}
