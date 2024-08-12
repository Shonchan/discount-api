<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\ChildrenDiscount;
use App\Entity\EarlyBookingDiscount;
use App\Entity\Trip;
use App\Model\DiscountResponse;
use App\Repository\DiscountRepository;
use App\Service\DiscountService;
use PHPUnit\Framework\TestCase;

class DiscountServiceTest extends TestCase
{
    public function testGetTotalDiscountNoChildren():void
    {
        $trip = (new Trip())
            ->setBasePrice(10000)
            ->setTripStartDate('01.05.2027')
            ->setPaymentDate('04.11.2026')
            ->setBirthDate('03.02.2000');

        $repository = new DiscountRepository();
        $service = new DiscountService($repository);

        $expected = new DiscountResponse(
            10000-700,
        700,
            [
                ChildrenDiscount::class => 0,
                EarlyBookingDiscount::class => 700
            ]
        );

        $this->assertEquals($expected, $service->getTotalDiscount($trip));
    }

    public function testGetTotalDiscount():void
    {
        $trip = (new Trip())
            ->setBasePrice(10000)
            ->setTripStartDate('01.05.2027')
            ->setPaymentDate('04.11.2026')
            ->setBirthDate('03.02.2010');

        $repository = new DiscountRepository();
        $service = new DiscountService($repository);

        $expected = new DiscountResponse(
            8370,
        1630,
            [
                ChildrenDiscount::class => 1000,
                EarlyBookingDiscount::class => 630
            ]
        );

        $this->assertEquals($expected, $service->getTotalDiscount($trip));
    }
}
