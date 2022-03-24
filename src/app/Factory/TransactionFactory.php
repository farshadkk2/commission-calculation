<?php


namespace App\Factory;

use App\Exception\TransactionException;
use Domain\Commission\Model\Currency;
use Domain\Commission\Model\Transaction;

class TransactionFactory
{
    /**
     * @param $date
     * @param $userId
     * @param $userType
     * @param $operationType
     * @param $amount
     * @param Currency $currency
     * @return Transaction
     */

    public function create($date, $userId, $userType, $operationType, $amount, Currency $currency): Transaction
    {
        $className = "Domain\\Commission\\Model\\" . ucfirst($operationType);

        if (!class_exists($className)) {
            throw new TransactionException('Incorrect transaction type');
        }

        return new $className(
            CommissionFactory::create($operationType, $userType),
            $date,
            $userId,
            $userType,
            $operationType,
            $amount,
            $currency
        );
    }
}
