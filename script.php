<?php

use Domain\Commission\DTOs\InputData;
use Service\CsvInput;
use Service\CurrencyExchange;
use Service\DataParser;
use Service\Formatter;
use Service\Message;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/service/Helper.php';

$input = (new CsvInput($argv))->getData();

foreach ($input as $i => $item) {
    $row = InputData::fromConsole($item);

    // Handling for working without api and show cool messages for any flows :)
    try {
        $rate = CurrencyExchange::api($row->currency);
    } catch (Exception $e) {
        echo Message::showWithTitle(
            "Input of line # " . (++$i) . " csv file",
            Message::error($e->getMessage()) .
            Message::info("Sorry Can't Get Response from CurrencyExchange API, The Script Switch To Default Rates")
        );

        try {
            $rate = CurrencyExchange::defaultList($row->currency);
        } catch (Exception $e) {
            echo Message::error($e->getMessage());
            continue;
        }
    }

    $PrecisionCount = precisionCount($row->amount);
    $transaction = DataParser::toModel($row);
    $transaction->getCurrency()->setRate($rate);
    $transaction->getCurrency()->setPrecisionCount($PrecisionCount);
    $commission = $transaction->commission();
    echo Formatter::printResult($commission, $PrecisionCount) . PHP_EOL;
}
