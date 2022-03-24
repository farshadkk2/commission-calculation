<?php


namespace App\Factory;

use App\Exception\CommissionException;
use DI\Container;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Domain\Commission\Commission;
use Service\Message;

class CommissionFactory
{

    /**
     * @return Container
     */
    public static function getContainer(): Container
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(__DIR__ . '../../Provider/CommissionFactory.php');
        try {
            return $builder->build();
        } catch (\Exception $e) {
            echo Message::error($e->getMessage());
            exit();
        }
    }

    /**
     * @param string $operationType
     * @param string $userType
     * @return Commission
     */
    public static function create(string $operationType, string $userType): Commission
    {
        if ($operationType == 'deposit') {
            try {
                return self::getContainer()->get("DepositCommission");
            } catch (DependencyException | NotFoundException $e) {
                echo Message::error($e->getMessage());
                exit();
            }
        } elseif ($operationType == 'withdraw') {
            if ($userType == "private") {
                try {
                    return self::getContainer()->get("PrivateWithdrawCommission");
                } catch (DependencyException | NotFoundException $e) {
                    echo Message::error($e->getMessage());
                    exit();
                }
            } elseif ($userType == "business") {
                try {
                    return self::getContainer()->get("BusinessWithdrawCommission");
                } catch (DependencyException | NotFoundException $e) {
                    echo Message::error($e->getMessage());
                    exit();
                }
            } else {
                throw new CommissionException('Incorrect user type');
            }
        } else {
            throw new CommissionException('Incorrect operation type');
        }
    }
}
