<?php

namespace App\Model;

class DiscountResponse
{
    public function __construct(private int $total, private array $discounts)
    {
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getDiscounts(): array
    {
        return $this->discounts;
    }

}