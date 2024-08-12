<?php

namespace App\Service;

use App\Entity\ChildrenDiscount;
use App\Entity\EarlyBookingDiscount;
use App\Entity\Trip;
use App\Model\DiscountResponse;
use App\Repository\DiscountRepository;

class DiscountService
{
    public function __construct(private DiscountRepository $discountRepository)
    {
    }

    /**
     * @throws \Exception
     */
    public function getTotalDiscount(Trip $trip): DiscountResponse
    {
        $totalDiscount = 0;
        $discounts = $this->discountRepository->getAllDiscounts($trip);

        $childrenDiscount = $discounts[ChildrenDiscount::class]->calculate();
        $totalDiscount += $childrenDiscount;

        $discounts[EarlyBookingDiscount::class]->setBasePrice(
            $discounts[ChildrenDiscount::class]->getBasePrice() - $childrenDiscount
        );
        $earlyBookingDiscount = $discounts[EarlyBookingDiscount::class]->calculate();
        $totalDiscount += $earlyBookingDiscount;

        return new DiscountResponse($totalDiscount, [
            ChildrenDiscount::class => $childrenDiscount,
            EarlyBookingDiscount::class => $earlyBookingDiscount
        ]);
    }
}