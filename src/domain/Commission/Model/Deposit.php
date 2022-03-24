<?php


namespace Domain\Commission\Model;

use Domain\Commission\Commission;

class Deposit extends Transaction
{

    private Commission $commission;

    public function __construct(Commission $commission, $date, $userId, $userType, $operationType, $amount, $currency)
    {
        parent::__construct($date, $userId, $userType, $operationType, $amount, $currency);
        $this->commission = $commission;
    }

    public function commission(): float
    {
        return $this->commission->calculate($this);
    }
}
