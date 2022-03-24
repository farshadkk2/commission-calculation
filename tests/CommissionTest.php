<?php


namespace tests;

use Domain\Commission\DTOs\InputData;
use Exception;
use PHPUnit\Framework\TestCase;
use Service\CurrencyExchange;
use Service\DataParser;
use Service\Formatter;

class CommissionTest extends TestCase
{
    public function dataProviderForCommissionCalculationTesting(): array
    {
        return [
            [["2014-12-31", "4", "private", "withdraw", "1200.00", "EUR"], 0.60],
            [["2015-01-01", "4", "private", "withdraw", "1000.00", "EUR"], 3.00],
            [["2016-01-05", "4", "private", "withdraw", "1000.00", "EUR"], 0.00],
            [["2016-01-05", "1", "private", "deposit", "200.00", "EUR"], 0.06],
            [["2016-01-06", "2", "business", "withdraw", "300.00", "EUR"], 1.50],
            [["2016-01-06", "1", "private", "withdraw", "30000", "JPY"], 0],
            [["2016-01-07", "1", "private", "withdraw", "1000.00", "EUR"], 0.70],
            [["2016-01-07", "1", "private", "withdraw", "100.00", "USD"], 0.30],
            [["2016-01-10", "1", "private", "withdraw", "100.00", "EUR"], 0.30],
            [["2016-01-10", "2", "business", "deposit", "10000.00", "EUR"], 3.00],
            [["2016-01-10", "3", "private", "withdraw", "1000.00", "EUR"], 0.00],
            [["2016-02-15", "1", "private", "withdraw", "300.00", "EUR"], 0.00],
            [["2016-02-19", "5", "private", "withdraw", "3000000", "JPY"], 8612],
        ];
    }

    /**
     *
     * @dataProvider dataProviderForCommissionCalculationTesting
     *  the commission is calculated base on the following exchange rates: EUR:USD - 1:1.1497, EUR:JPY - 1:129.53.
     * @param $row
     * @param $expected
     * @throws Exception
     */
    public function testCommissionCalculation($row, $expected)
    {
        $row = InputData::fromConsole($row);

        $rate = CurrencyExchange::defaultList($row->currency);

        $transaction = DataParser::toModel($row);
        $transaction->getCurrency()->setRate($rate);

        $PrecisionCountArray = explode('.', $row->amount);

        if (!isset($PrecisionCountArray[1])) {
            $PrecisionCount = 0;
        } else {
            $PrecisionCount = strlen($PrecisionCountArray[1]);
        }

        $transaction->getCurrency()->setPrecisionCount($PrecisionCount);

        $commission = $transaction->commission();

        $result = Formatter::printResult($commission, $PrecisionCount);
        $expected = Formatter::printResult($expected, $PrecisionCount);

        $this->assertEquals(
            $result,
            $expected
        );
    }
}
