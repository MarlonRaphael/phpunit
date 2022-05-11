<?php

namespace OrderBundle\Test\Entity;

use JetBrains\PhpStorm\ArrayShape;
use OrderBundle\Entity\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /**
     * @test
     * @dataProvider customerAllowedDataProvider
     * @param $isActive
     * @param $isBlocked
     * @param $expectedAllowed
     * @return void
     */
    public function isAllowedToOrder($isActive, $isBlocked, $expectedAllowed): void
    {
        $customer = new Customer($isActive, $isBlocked, 'Marlon Raphael', '+5541991756758');

        $isAllowed = $customer->isAllowedToOrder();

        $this->assertEquals($expectedAllowed, $isAllowed);
    }

    /**
     * @return array
     */
    #[ArrayShape([
        'shouldBeAllowedWhenIsActiveAndNotBlocked' => "array",
        'shouldNotBeAllowedWhenIsNotActiveButIsBlocked' => "array",
        'shouldNotBeAllowedWhenIsNotActive' => "false[]",
        'shouldNotBeAllowedWhenIsNotActiveAndIsBlocked' => "array"])] public function customerAllowedDataProvider(): array
    {
        return [
            'shouldBeAllowedWhenIsActiveAndNotBlocked' => [
                'isActive' => true,
                'isBlocked' => false,
                'expectedAllowed' => true
            ],
            'shouldNotBeAllowedWhenIsNotActiveButIsBlocked' => [
                'isActive' => true,
                'isBlocked' => true,
                'expectedAllowed' => false
            ],
            'shouldNotBeAllowedWhenIsNotActive' => [
                'isActive' => false,
                'isBlocked' => false,
                'expectedAllowed' => false
            ],
            'shouldNotBeAllowedWhenIsNotActiveAndIsBlocked' => [
                'isActive' => false,
                'isBlocked' => true,
                'expectedAllowed' => false
            ],
        ];
    }
}
