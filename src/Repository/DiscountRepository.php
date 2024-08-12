<?php

namespace App\Repository;

use App\Entity\ChildrenDiscount;
use App\Entity\EarlyBookingDiscount;
use App\Entity\IDiscount;
use App\Entity\Trip;

class DiscountRepository
{
    /**
     * @param Trip $trip
     * @throws \Exception
     * @return IDiscount[]
     */
    public function getAllDiscounts(Trip $trip): array
    {
        return [
            ChildrenDiscount::class => ChildrenDiscount::create($trip),
            EarlyBookingDiscount::class => EarlyBookingDiscount::create($trip),
        ];
    }
}