<?php


namespace Domain\Commission\DTOs;

class ApiData
{

    public string $base;
    public string $date;
    public object $rates;

    /**
     * @param $response
     * @return static
     */
    public static function fromApi($response): self
    {
        $dto = new self();
        $dto->base = $response->base;
        $dto->date = $response->date;
        $dto->rates = $response->rates;
        return $dto;
    }
}
