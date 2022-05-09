<?php

namespace OrderBundle\Validators\Test;

use OrderBundle\Validators\NotEmptyValidator;
use PHPUnit\Framework\TestCase;

class NotEmptyValidatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider valueProvider
     * @param $value
     * @param $expectedResult
     * @return void
     */
    public function testIsValid($value, $expectedResult): void
    {
        $notEmptyValidator = new NotEmptyValidator($value);

        $isValid = $notEmptyValidator->isValid();

        $this->assertEquals($expectedResult, $isValid);
    }

    public function valueProvider()
    {
        return [
            'testShouldNotBeValidWhenValueIsEmpty' => ['value' => 'foo', 'expectedResult' => true],
            'testShouldBeValidWhenValueIsNotEmpty' => ['value' => '', 'expectedResult' => false],
        ];
    }

    /**
     * @test
     * @return void
     */
//    public function testShouldNotBeValidWhenValueIsEmpty(): void
//    {
//        $dataProvider = [
//            "" => false,
//            "foo" => true
//        ];
//
//        foreach ($dataProvider as $value => $expectedResult) {
//            $notEmptyValidator = new NotEmptyValidator($value);
//
//            $isValid = $notEmptyValidator->isValid();
//
//            $this->assertEquals($expectedResult, $isValid);
//        }
//    }

    /**
     * @test
     * @return void
     */
//    public function testShouldBeValidWhenValueIsNotEmpty(): void
//    {
//        $notEmptyValue = "foo bar";
//        $notEmptyValidator = new NotEmptyValidator($notEmptyValue);
//
//        $isValid = $notEmptyValidator->isValid();
//
//        $this->assertTrue($isValid);
//    }

}
