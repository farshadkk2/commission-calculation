<?php


namespace Domain\Commission\Model;

class Currency
{
    private string $symbol;
    private float $rate;
    private int $precisionCount;

    public function __construct($symbol)
    {
        $this->symbol = $symbol;
    }

    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getPrecisionCount(): int
    {
        return $this->precisionCount;
    }

    public function setPrecisionCount($places)
    {
        $this->precisionCount = $places;
    }
}
