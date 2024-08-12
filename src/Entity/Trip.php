<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints\Type;

class Trip
{
    #[Type('float')]
    private float $basePrice;
    #[Type('string')]
    private string $tripStartDate;
    #[Type('string')]
    private string $paymentDate;
    #[Type('string')]
    private string $birthDate;

    public function getBasePrice(): float
    {
        return $this->basePrice;
    }

    public function setBasePrice(float $basePrice): void
    {
        $this->basePrice = $basePrice;
    }

    public function getTripStartDate(): string
    {
        return $this->tripStartDate;
    }

    public function setTripStartDate(string $tripStartDate): void
    {
        $this->tripStartDate = $tripStartDate;
    }

    public function getPaymentDate(): string
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(string $paymentDate): void
    {
        $this->paymentDate = $paymentDate;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }


}