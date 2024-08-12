<?php

namespace App\Model;

class DiscountResponse
{
    public function __construct(private int $totalPrice, private int $totalDiscount, private array $discounts)
    {
    }

    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    public function getTotalDiscount(): int
    {
        return $this->totalDiscount;
    }


    public function getDiscounts(): array
    {
        return $this->discounts;
    }

}