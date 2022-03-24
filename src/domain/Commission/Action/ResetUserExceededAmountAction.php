<?php


namespace Domain\Commission\Action;

final class ResetUserExceededAmountAction
{
    /**
     * @param $userId
     */
    public function __invoke($userId): void
    {
        $_SESSION[$userId]["exceeded_amount"] = 0;
    }
}
