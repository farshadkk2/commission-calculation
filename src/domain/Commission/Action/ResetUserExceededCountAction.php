<?php


namespace Domain\Commission\Action;

final class ResetUserExceededCountAction
{
    /**
     * @param $userId
     */
    public function __invoke($userId): void
    {
        $_SESSION[$userId]["exceeded_count"] = 0;
    }
}
