<?php

namespace Domain\Commission\DTOs;

use DateTime;

class InputData
{
    public string $date;
    public int $userId;
    public string $userType;
    public string $operationType;
    public string $amount;
    public string $currency;

    /**
     * @param array $data
     * @return static
     */
    public static function fromConsole(array $data): self
    {
        $dto = new self();
        $dto->date = DateTime::createFromFormat('Y-m-d', $data[0])->format('Y-m-d');
        $dto->userId = trim($data[1]);
        $dto->userType = trim($data[2]);
        $dto->operationType = trim($data[3]);
        $dto->amount = trim($data[4]);
        $dto->currency = trim($data[5]);

        return $dto;
    }
}
