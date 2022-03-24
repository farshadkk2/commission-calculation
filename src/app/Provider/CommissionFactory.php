<?php


use Config\Charge;
use Domain\Commission\Impl\BusinessWithdrawCommission;
use Domain\Commission\Impl\PrivateWithdrawCommission;
use Service\Math;
use Domain\Commission\Impl\DepositCommission;

$math = new Math(Charge::MATH_SCALE);

return [
    'DepositCommission' => function () use ($math) {
        return new DepositCommission($math);
    },
    'PrivateWithdrawCommission' => function () use ($math) {
        return new PrivateWithdrawCommission($math);
    },
    'BusinessWithdrawCommission' => function () use ($math) {
        return new BusinessWithdrawCommission($math);
    }
];
