<?php


namespace Domain\Commission\Action;

final class SetUserExceededAmountAction
{
    /**
     * @param $amount
     * @param $userId
     */
    public function __invoke($amount, $userId): void
    {
        $_SESSION[$userId]["exceeded_amount"] =
            (isset($_SESSION[$userId]["exceeded_amount"])) ?
                $_SESSION[$userId]["exceeded_amount"] + $amount: $amount;
    }
}
