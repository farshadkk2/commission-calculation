<?php

namespace Domain\Commission\Action;

final class CheckUserExceededAmountDoneAction
{
    /**
     * @param $userId
     * @return bool
     */
    public function __invoke($userId): bool
    {
        return (isset($_SESSION[$userId]["exceeded_amount_done"])) ?
            $_SESSION[$userId]["exceeded_amount_done"]: false;
    }
}
