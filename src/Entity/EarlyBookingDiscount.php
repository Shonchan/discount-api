<?php

namespace App\Entity;

use App\Exception\InvalidDiffException;

class EarlyBookingDiscount extends Discount
{
    private int $childrenDiscount = 0;

    public function calculate(): int
    {
        $diff = $this->getTripStartDate()->diff($this->getPaymentDate())->y;
        if($diff < 0) {
            throw new InvalidDiffException();
        }

        if($diff === 0) {
            return 0;
        }

        return  $this->getDiscount($diff);

    }

    public function getChildrenDiscount(): int
    {
        return $this->childrenDiscount;
    }

    public function setChildrenDiscount(int $childrenDiscount): void
    {
        $this->childrenDiscount = $childrenDiscount;
    }

    private function getDiscount(int $diff): int
    {
        if ($diff >= 2) {
            return min(1500, ceil(($this->getBasePrice() - $this->getChildrenDiscount()) * 7 / 100));
        }

        if($diff === 1) {
            $begin = new \DateTime('01.04.'.$this->getTripStartDate()->format('Y'));
            $end = new \DateTime('30.09.'.$this->getTripStartDate()->format('Y'));
            if ($begin->getTimestamp() <= $this->getTripStartDate()->getTimestamp()
                && $this->getTripStartDate()->getTimestamp() <= $end->getTimestamp()) {
                $payment = new \DateTime('30.11.'.$this->getPaymentDate()->format('Y'));
                if ($this->getPaymentDate()->getTimestamp() <= $payment->getTimestamp()) {
                    return min(1500, ceil(($this->getBasePrice() - $this->getChildrenDiscount()) * 7 / 100));
                }
                $payment = new \DateTime('31.12.'.$this->getPaymentDate()->format('Y'));
                if ($this->getPaymentDate()->getTimestamp() <= $payment->getTimestamp()) {
                    return min(1500, ceil(($this->getBasePrice() - $this->getChildrenDiscount()) * 5 / 100));
                }
                $payment = new \DateTime('31.01.'.((int)$this->getPaymentDate()->format('Y') + 1));
                if ($this->getPaymentDate()->getTimestamp() <= $payment->getTimestamp()) {
                    return min(1500, ceil(($this->getBasePrice() - $this->getChildrenDiscount()) * 3 / 100));
                }
            }
            $begin = new \DateTime('01.10.'.((int)$this->getTripStartDate()->format('Y') - 1));
            $end = new \DateTime('14.01.'.$this->getTripStartDate()->format('Y'));
            if ($begin->getTimestamp() <= $this->getTripStartDate()->getTimestamp()
                && $this->getTripStartDate()->getTimestamp() <= $end->getTimestamp()) {
                $payment = new \DateTime('31.03.'.$this->getPaymentDate()->format('Y'));
                if ($this->getPaymentDate()->getTimestamp() <= $payment->getTimestamp()) {
                    return min(1500, ceil(($this->getBasePrice() - $this->getChildrenDiscount()) * 7 / 100));
                }
                $payment = new \DateTime('30.04.'.$this->getPaymentDate()->format('Y'));
                if ($this->getPaymentDate()->getTimestamp() <= $payment->getTimestamp()) {
                    return min(1500, ceil(($this->getBasePrice() - $this->getChildrenDiscount()) * 5 / 100));
                }
                $payment = new \DateTime('31.05.'.$this->getPaymentDate()->format('Y'));
                if ($this->getPaymentDate()->getTimestamp() <= $payment->getTimestamp()) {
                    return min(1500, ceil(($this->getBasePrice() - $this->getChildrenDiscount()) * 3 / 100));
                }
            }
            $begin = new \DateTime('05.01.'.$this->getTripStartDate()->format('Y'));
            if ($begin->getTimestamp() <= $this->getTripStartDate()->getTimestamp()) {
                $payment = new \DateTime('31.08.'.$this->getPaymentDate()->format('Y'));
                if ($this->getPaymentDate()->getTimestamp() <= $payment->getTimestamp()) {
                    return min(1500, ceil(($this->getBasePrice() - $this->getChildrenDiscount()) * 7 / 100));
                }
                $payment = new \DateTime('30.09.'.$this->getPaymentDate()->format('Y'));
                if ($this->getPaymentDate()->getTimestamp() <= $payment->getTimestamp()) {
                    return min(1500, ceil(($this->getBasePrice() - $this->getChildrenDiscount()) * 5 / 100));
                }
                $payment = new \DateTime('31.10.'.$this->getPaymentDate()->format('Y'));
                if ($this->getPaymentDate()->getTimestamp() <= $payment->getTimestamp()) {
                    return min(1500, ceil(($this->getBasePrice() - $this->getChildrenDiscount()) * 3 / 100));
                }
            }
        }
        return  0;
    }
}