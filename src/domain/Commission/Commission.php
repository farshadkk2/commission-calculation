<?php


namespace Domain\Commission;

use Domain\Commission\Model\Transaction;

interface Commission
{
    /**
     * @param Transaction $transaction
     * @return float
     */

    public function calculate(Transaction $transaction): float;
}
