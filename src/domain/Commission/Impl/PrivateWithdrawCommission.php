<?php


namespace Domain\Commission\Impl;

use Config\Charge;
use Domain\Commission\Action\CheckUserExceededAmountDoneAction;
use Domain\Commission\Action\CheckUserFreeCommissionAction;
use Domain\Commission\Action\SetUserExceededAmountAction;
use Domain\Commission\Action\SetUserExceededAmountDoneAction;
use Domain\Commission\Action\SetUserExceededCountAction;
use Domain\Commission\Action\SetUserExceededDateAction;
use Domain\Commission\Commission;
use Domain\Commission\Model\Transaction;
use Service\Math;

class PrivateWithdrawCommission implements commission
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
        $amount = $transaction->getAmount();
        $rate = $transaction->getCurrency()->getRate();

        $amountToEur = $this->math->div($amount, $rate);

        (new SetUserExceededDateAction())($transaction->getDate(), $transaction->getUserId());
        (new SetUserExceededCountAction())($transaction->getUserId());
        (new SetUserExceededAmountAction())($amountToEur, $transaction->getUserId());
        $isFreeCommission = (new CheckUserFreeCommissionAction())($transaction->getUserId());

        if ($isFreeCommission) {
            return 0;
        } else {
            $exceededAmount = $_SESSION[$transaction->getUserId()]["exceeded_amount"];
            $isUserExceededAmountDone = (new CheckUserExceededAmountDoneAction())($transaction->getUserId());

            if ($exceededAmount > Charge::TOTAL_FREE_OF_CHARGE && $isUserExceededAmountDone === false) {
                $commission =
                    $this->math->mul(($exceededAmount - Charge::TOTAL_FREE_OF_CHARGE), Charge::PRIVATE_WITHDRAW);
                $commission = $this->math->mul($commission, $rate);

                (new SetUserExceededAmountDoneAction())($transaction->getUserId());
            } else {
                $commission = $this->math->mul($amount, Charge::PRIVATE_WITHDRAW);
            }
        }

        return $this->math->roundUp($commission, $transaction->getCurrency()->getPrecisionCount());
    }
}
