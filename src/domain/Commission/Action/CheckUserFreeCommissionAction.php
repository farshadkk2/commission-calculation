<?php


namespace Domain\Commission\Action;

use Config\Charge;

final class CheckUserFreeCommissionAction
{
    /**
     * @param $userId
     * @return bool
     */
    public function __invoke($userId): bool
    {
        return $_SESSION[$userId]["exceeded_count"] <= Charge::FREE_OF_CHARGE_TRANSACTION_NUM &&
            $_SESSION[$userId]["exceeded_amount"] <= Charge::TOTAL_FREE_OF_CHARGE;
    }
}
