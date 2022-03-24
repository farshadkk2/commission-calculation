<?php


namespace Service;

use App\Factory\TransactionFactory;
use Domain\Commission\Model\Currency;
use Domain\Commission\Model\Transaction;

class DataParser
{
    public static function toModel($inputData): Transaction
    {
        $transactionFactory = new TransactionFactory();

        return $transactionFactory->create(
            $inputData->date,
            $inputData->userId,
            $inputData->userType,
            $inputData->operationType,
            $inputData->amount,
            new Currency($inputData->currency)
        );
    }
}
