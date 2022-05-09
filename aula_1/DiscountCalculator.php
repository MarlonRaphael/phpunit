<?php

class DiscountCalculator
{
    public const MINIMUM_VALUE = 100;
    public const DISCOUNT_VALUE = 20;

    /**
     * @param $value
     * @return int
     */
    public function apply($value): int
    {
        if ($value > self::MINIMUM_VALUE) {
            return $value - self::DISCOUNT_VALUE;
        }

        return $value;
    }

}
