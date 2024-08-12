<?php

namespace App\Entity;

use App\Exception\InvalidDiffException;

class EarlyBookingDiscount extends Discount
{
    public function calculate(): int
    {
        $diff = (int)$this->getTripStartDate()->format('Y') -
                (int)$this->getPaymentDate()->format('Y');

        if($diff < 0) {
            throw new InvalidDiffException();
        }

        return  $this->getDiscount($diff);

    }

    private function getDiscount(int $diff): int
    {
        if ($diff >= 2) {
            return min(1500, ceil($this->getBasePrice() * 7 / 100));
        }

        $earlyDiscount = 0;

        if($diff >= 0) {
            $year = (int)$this->getPaymentDate()->format('Y');
            $begin = new \DateTime('01.04.'.($diff === 0 ? $year : $year+1));
            $end = new \DateTime('30.09.'.($diff === 0 ? $year : $year+1));
            if ($begin->getTimestamp() <= $this->getTripStartDate()->getTimestamp()
                && $this->getTripStartDate()->getTimestamp() <= $end->getTimestamp()) {
              $days_diff = $begin->diff($this->getPaymentDate())->days;
              if($days_diff > 59) {
                  $earlyDiscount = min(1500, ceil($this->getBasePrice() * 3 / 100));
              }
              if($days_diff > 90) {
                  $earlyDiscount = min(1500, ceil($this->getBasePrice() * 5 / 100));
              }
              if($days_diff > 121) {
                  $earlyDiscount = min(1500, ceil($this->getBasePrice() * 7 / 100));
              }
            }
            $begin = new \DateTime('01.10.'.$year);
            $end = new \DateTime('14.01.'.($year+1));
            if ($earlyDiscount === 0 && $begin->getTimestamp() <= $this->getTripStartDate()->getTimestamp()
                && $this->getTripStartDate()->getTimestamp() <= $end->getTimestamp()) {
                $days_diff = $begin->diff($this->getPaymentDate())->days;
                if($days_diff > 122) {
                    $earlyDiscount = min(1500, ceil($this->getBasePrice() * 3 / 100));
                }
                if($days_diff > 153) {
                    $earlyDiscount = min(1500, ceil($this->getBasePrice() * 5 / 100));
                }
                if($days_diff > 183) {
                    $earlyDiscount = min(1500, ceil($this->getBasePrice() * 7 / 100));
                }
            }
            $begin = new \DateTime('15.01.'.($year+1));
            if ($earlyDiscount === 0 && $begin->getTimestamp() <= $this->getTripStartDate()->getTimestamp()) {
                $days_diff = $begin->diff($this->getPaymentDate())->days;
                if($days_diff > 75) {
                    $earlyDiscount = min(1500, ceil($this->getBasePrice() * 3 / 100));
                }
                if($days_diff > 116) {
                    $earlyDiscount = min(1500, ceil($this->getBasePrice() * 5 / 100));
                }
                if($days_diff > 146) {
                    $earlyDiscount = min(1500, ceil($this->getBasePrice() * 7 / 100));
                }
            }
        }
        return  $earlyDiscount;
    }
}