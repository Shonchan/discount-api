<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints\Type;

class Trip
{
    #[Type('int')]
    private int $basePrice;
    #[Type('string')]
    private string $tripStartDate;
    #[Type('string')]
    private string $paymentDate;
    #[Type('string')]
    private string $birthDate;

    public function getBasePrice(): int
    {
        return $this->basePrice;
    }

    public function setBasePrice(int $basePrice): static
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    public function getTripStartDate(): string
    {
        return $this->tripStartDate;
    }

    public function setTripStartDate(string $tripStartDate): static
    {
        $this->tripStartDate = $tripStartDate;

        return $this;
    }

    public function getPaymentDate(): string
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(string $paymentDate): static
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }


}