<?php


namespace Domain\Commission\Action;

final class SetUserExceededCountAction
{
    /**
     * @param $userId
     */
    public function __invoke($userId): void
    {
        $_SESSION[$userId]["exceeded_count"] =
            (isset($_SESSION[$userId]["exceeded_count"])) ?
                $_SESSION[$userId]["exceeded_count"] + 1: 1;
    }
}
