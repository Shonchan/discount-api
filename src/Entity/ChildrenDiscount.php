<?php

namespace App\Entity;

use App\Exception\InvalidAgeException;

class ChildrenDiscount extends Discount
{
    public function calculate(): int
    {
        $today = new \DateTime('today');
        $age = $this->getBirthDate()->diff($today)->y;

        return $this->getDiscountForAge($age);
    }

    private function getDiscountForAge(int $age): int
    {
        if($age < 3) {
            throw new InvalidAgeException();
        }

        if($age >= 18) {
            return 0;
        }
        if($age >= 12) {
            return ceil($this->getBasePrice() * 10 / 100);
        }
        if($age >= 6) {
            return min(ceil($this->getBasePrice() * 30 / 100), 4500);
        }

        return ceil($this->getBasePrice() * 80 / 100);
    }
}