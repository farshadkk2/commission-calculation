<?php


namespace Domain\Commission\Action;

final class SetUserExceededAmountDoneAction
{
    /**
     * @param $userId
     */
    public function __invoke($userId): void
    {
        $_SESSION[$userId]["exceeded_amount_done"] = true;
    }
}
