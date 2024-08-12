<?php

namespace App\Entity;

interface IDiscount
{
    public function calculate(): int;
}