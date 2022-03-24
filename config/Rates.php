<?php


namespace Config;

class Rates
{
    /**
     * Get Default Rates
     * @return array
     */
    public static function get(): array
    {
        return [
            'EUR' => 1,
            'USD' => 1.1497,
            'JPY' => 129.53
        ];
    }
}
