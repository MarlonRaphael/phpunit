<?php

namespace PaymentBundle\Test\Service;

use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase
{
    private $array;

    public static function setUpBeforeClass(): void
    {
        //
    }

    /**
     * @test
     * @return void
     */
    public function shouldBeFilled()
    {
        $this->array = ['hello' => 'world'];

        $this->assertNotEmpty($this->array);
    }

    /**
     * @test
     * @return void
     */
    public function shouldBeEmpty()
    {
        $this->assertEmpty($this->array);
    }
}
