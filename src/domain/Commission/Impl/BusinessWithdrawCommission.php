<?php


namespace Domain\Commission\Impl;

use Config\Charge;
use Domain\Commission\Commission;
use Domain\Commission\Model\Transaction;
use Service\Math;

class BusinessWithdrawCommission implements commission
{

    /**
     * @var Math
     */
    private Math $math;

    public function __construct(Math $math)
    {
        $this->math = $math;
    }

    public function calculate(Transaction $transaction): float
    {
        $commission = $this->math->mul($transaction->getAmount(), Charge::BUSINESS_WITHDRAW);
        return $this->math->roundUp($commission, $transaction->getCurrency()->getPrecisionCount());
    }
}
