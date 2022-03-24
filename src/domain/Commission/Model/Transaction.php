<?php


namespace Domain\Commission\Model;

abstract class Transaction
{
    protected string $date;
    protected int $userId;
    protected string $userType;
    protected string $operationType;
    protected float $amount;
    protected Currency $currency;

    public function __construct($date, $userId, $userType, $operationType, $amount, Currency $currency)
    {
        $this->date = $date;
        $this->userId = $userId;
        $this->userType = $userType;
        $this->operationType = $operationType;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    abstract public function commission(): float;
}
