<?php

declare(strict_types=1);

namespace Entity;

use App\Entity\ChildrenDiscount;
use App\Entity\Trip;
use App\Exception\InvalidAgeException;
use PHPUnit\Framework\TestCase;

class ChildrenDiscountTest extends TestCase
{
    public function testCalculateThrowException(): void
    {
        $discount = ChildrenDiscount::create((new Trip())
            ->setBasePrice(250000)
            ->setTripStartDate('31.08.2025')
            ->setPaymentDate('04.05.2024')
            ->setBirthDate('03.02.2026'));
        $this->expectException(InvalidAgeException::class);
        $discount->calculate();
    }

    public function testCalculate(): void
    {
        $trip = (new Trip())
            ->setBasePrice(25000)
            ->setTripStartDate('31.08.2025')
            ->setPaymentDate('04.05.2024')
            ->setBirthDate('03.02.2020');

        $discount = ChildrenDiscount::create($trip);

        $this->assertEquals(20000, $discount->calculate());

        $discount->setBirthDate(new \DateTime('03.02.2018'));
        $this->assertEquals(4500, $discount->calculate());

        $discount->setBirthDate(new \DateTime('03.02.2010'));
        $this->assertEquals(2500, $discount->calculate());

        $discount->setBirthDate(new \DateTime('03.02.2000'));
        $this->assertEquals(0, $discount->calculate());
    }

}
