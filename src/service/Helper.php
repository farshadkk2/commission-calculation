<?php

if (!function_exists('precisionCount')) {
    /**
     * Retrieve request user
     *
     * @param string $value
     * @return mixed
     */
    function precisionCount(string $value): int
    {

        $PrecisionCountArray = explode('.', $value);

        if (!isset($PrecisionCountArray[1])) {
            $PrecisionCount = 0;
        } else {
            $PrecisionCount = strlen($PrecisionCountArray[1]);
        }

        return $PrecisionCount;
    }
}
