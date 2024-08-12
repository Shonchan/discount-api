<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints\Type;

abstract class Discount implements IDiscount
{
    #[Type('float')]
    private float $basePrice;
    #[Type('\DateTimeInterface')]
    private \DateTimeInterface $tripStartDate;
    #[Type('\DateTimeInterface')]
    private \DateTimeInterface $paymentDate;
    #[Type('\DateTimeInterface')]
    private \DateTimeInterface $birthDate;

    public function getBasePrice(): float
    {
        return $this->basePrice;
    }

    public function setBasePrice(float $basePrice): void
    {
        $this->basePrice = $basePrice;
    }

    public function getTripStartDate(): \DateTimeInterface
    {
        return $this->tripStartDate;
    }

    public function setTripStartDate(\DateTimeInterface $tripStartDate): void
    {
        $this->tripStartDate = $tripStartDate;
    }

    public function getPaymentDate(): \DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(\DateTimeInterface $paymentDate): void
    {
        $this->paymentDate = $paymentDate;
    }

    public function getBirthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @throws \Exception
     */
    public static function create(Trip $trip): static
    {
        $discount = new static();
        $discount->setBasePrice($trip->getBasePrice());
        $discount->setPaymentDate(new \DateTime($trip->getPaymentDate()));
        $discount->setTripStartDate(new \DateTime($trip->getTripStartDate()));
        $discount->setBirthDate(new \DateTime($trip->getBirthDate()));
        return $discount;
    }

}