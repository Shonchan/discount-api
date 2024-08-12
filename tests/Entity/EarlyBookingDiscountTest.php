<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\EarlyBookingDiscount;
use App\Entity\Trip;
use App\Exception\InvalidDiffException;
use PHPUnit\Framework\TestCase;

class EarlyBookingDiscountTest extends TestCase
{

    public function testCalculateThrowException(): void
    {
        $discount = EarlyBookingDiscount::create((new Trip())
            ->setBasePrice(25000)
            ->setTripStartDate('31.08.2025')
            ->setPaymentDate('04.05.2026')
            ->setBirthDate('03.02.2020'));
        $this->expectException(InvalidDiffException::class);
        $discount->calculate();
    }
    public function testCalculate(): void
    {
        $trip = (new Trip())
            ->setBasePrice(10000)
            ->setTripStartDate('01.05.2027')
            ->setPaymentDate('04.11.2026')
            ->setBirthDate('03.02.2000');

        $discount = EarlyBookingDiscount::create($trip);
        $this->assertEquals(700, $discount->calculate());

        $discount->setPaymentDate(new \DateTime('14.12.2026'));
        $this->assertEquals(500, $discount->calculate());

        $discount->setPaymentDate(new \DateTime('14.01.2027'));
        $this->assertEquals(300, $discount->calculate());

        $discount->setTripStartDate(new \DateTime('20.12.2026'));
        $discount->setPaymentDate(new \DateTime('12.03.2026'));
        $this->assertEquals(700, $discount->calculate());

        $discount->setPaymentDate(new \DateTime('12.04.2026'));
        $this->assertEquals(500, $discount->calculate());

        $discount->setPaymentDate(new \DateTime('12.05.2026'));
        $this->assertEquals(300, $discount->calculate());

        $discount->setTripStartDate(new \DateTime('16.01.2027'));
        $discount->setPaymentDate(new \DateTime('04.08.2026'));
        $this->assertEquals(700, $discount->calculate());

        $discount->setPaymentDate(new \DateTime('10.09.2026'));
        $this->assertEquals(500, $discount->calculate());

        $discount->setPaymentDate(new \DateTime('12.10.2026'));
        $this->assertEquals(300, $discount->calculate());

    }
}
