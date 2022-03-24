<?php


namespace Domain\Commission\Action;

use Config\Charge;

final class SetUserExceededDateAction
{
    /**
     * @param $withdrawDate
     * @param $userId
     */
    public function __invoke($withdrawDate, $userId): void
    {

        if (isset($_SESSION[$userId]["exceed_end_date"])) {
            $withdrawDateObj = date_create_from_format('Y-m-d', $withdrawDate);
            $storedWithdrawDateObj = date_create_from_format('Y-m-d', $_SESSION[$userId]["exceed_end_date"]);

            $interval = date_diff($withdrawDateObj, $storedWithdrawDateObj);
            $intervalDays = $interval->days;
        } else {
            $intervalDays = 0;
        }

        if ($intervalDays > Charge::FREE_OF_CHARGE_TRANSACTION_DAY or !isset($_SESSION[$userId])) {
            $dayOfWeek = date('w', strtotime($withdrawDate));
            $endOfWeekDay = 6 - $dayOfWeek;
            $week_start_date = date('Y-m-d', strtotime($withdrawDate. ' - '.$dayOfWeek.' days'));
            $week_end_date = date('Y-m-d', strtotime($withdrawDate. ' + '.$endOfWeekDay.' days'));
            $_SESSION[$userId] = [
                "exceed_start_date" => $week_start_date,
                "exceed_end_date" => $week_end_date,
            ];
        }

        if ($intervalDays > Charge::FREE_OF_CHARGE_TRANSACTION_DAY) {
            (new ResetUserExceededCountAction())($userId);
            (new ResetUserExceededAmountAction())($userId);
        }
    }
}
