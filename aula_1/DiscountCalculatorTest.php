<?php

class DiscountCalculatorTest
{
    /**
     * @return void
     * @throws Exception
     */
    public function ShouldApply_WhenValueIsAboveTheMinumumTest(): void
    {
        $discountCalculator = new DiscountCalculator();

        $totalValue = 130;
        $totalWithDiscount = $discountCalculator->apply(130);

        $expectedValue = 110;
        $this->assertEquals($expectedValue, $totalWithDiscount);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function ShoudNotApply_WhenValueIsBellowTheMinimumTest(): void
    {
        $discountCalculator = new DiscountCalculator();

        $totalValue = 90;
        $totalWithDiscount = $discountCalculator->apply($totalValue);

        $expectedValue = 90;
        $this->assertEquals($expectedValue, $totalWithDiscount);
    }

    /**
     * @param $expectedValue
     * @param $actualValue
     * @return void
     * @throws Exception
     */
    public function assertEquals($expectedValue, $actualValue): void
    {
        if ($expectedValue !== $actualValue) {
            $message = "Expected: $expectedValue but got $actualValue";
            throw new \Exception($message);
        }

        echo "Test passed <br> \n";
    }

}
