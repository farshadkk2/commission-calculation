<?php


namespace Service;

use App\Exception\CurrencyExchangeApiException;
use Config\Rates;
use Curl\Curl;
use Domain\Commission\DTOs\ApiData;

class CurrencyExchange
{
    /**
     * @param $currency
     * @return float
     * @throws CurrencyExchangeApiException
     */

    public static function api($currency): float
    {
        $apiResponse = (new CurrencyExchange)->getResponse();
        return (new CurrencyExchange)->findRate($apiResponse->rates, $currency);
    }

    /**
     * @param $currency
     * @return float
     * @throws CurrencyExchangeApiException
     */
    public static function defaultList($currency): float
    {
        return (new CurrencyExchange)->findRate(Rates::get(), $currency);
    }

    /**
     * @return ApiData
     * @throws CurrencyExchangeApiException
     */
    public function getResponse(): ApiData
    {
        $curl = new Curl();
        $curl->get('https://developers.paysera.com/tasks/api/currency-exchange-rates');

        if ($curl->error) {
            throw new CurrencyExchangeApiException($curl->errorMessage);
        }

        return ApiData::fromApi($curl->response);
    }

    /**
     * @param $rateList
     * @param $currency
     * @return float
     * @throws CurrencyExchangeApiException
     */

    public function findRate($rateList, $currency): float
    {
        $rateList = (array)$rateList;

        if (!isset($rateList[$currency])) {
            throw new CurrencyExchangeApiException("Currency Type Is Not Valid");
        }
        return $rateList[$currency];
    }
}
