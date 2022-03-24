<?php


namespace Service;

use App\Exception\InputException;

final class CsvInput
{
    /**
     * @var array
     */

    private array $input;

    /**
     * @var string
     */

    private string $filePath;

    /**
     * Input constructor.
     * @param $input
     */
    public function __construct($input)
    {
        $this->input = $input;
        $this->validator();
    }

    /**
     * @return array
     */

    public function getData(): array
    {
        return $this->parseCsvFile();
    }

    /**
     * Check Input is Valid method
     */
    private function validator(): void
    {
        try {
            $this->isInputNameValid();
        } catch (InputException $e) {
            echo Message::error($e->getMessage());
            exit();
        }

        try {
            $this->isInputFileExist();
        } catch (InputException $e) {
            echo Message::error($e->getMessage());
            exit();
        }
    }

    /**
     * @throws InputException
     */
    private function isInputNameValid()
    {
        if (!isset($this->input[1])) {
            throw new InputException(
                "Input Error! You Should Send Csv File Path to Script. Please Run Script Like This:" .
                " php script.php inputs/sample.csv"
            );
        } else {
            $this->filePath = $this->input[1];
        }
    }


    /**
     * @throws InputException
     */
    private function isInputFileExist()
    {
        if (!file_exists($this->filePath)) {
            throw new InputException("File Error: Couldn't be Found CSV File");
        }
    }

    /**
     * @return array
     */
    private function parseCsvFile(): array
    {
        $array = [];

        if (($open = fopen($this->filePath, "r")) !== false) {
            while (($data = fgetcsv($open)) !== false) {
                $array[] = $data;
            }

            fclose($open);
        }
        return $array;
    }
}
