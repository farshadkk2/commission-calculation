# Commission Calculation task
## How To Run
### 1. install dependencies:
```shell
composer install
```
### 2. install PHP requirements extensions and certification
  - if you want to use online rates provided by https://developers.paysera.com/tasks/api/currency-exchange-rates, you should have `openssl` and `curl` extension installed in your PHP.
   By default, if the system couldn't access to API for any reason switched to default currency exchange rates that define in `config/rates.php`.<br>
    Already in an offline mode these rates are saved from task sample rates given.
    <br><br>
   - if you see this error:<br>
     `SSL peer certificate or SSH remote key was not OK: SSL certificate problem: unable to get local issuer certificate`
     you should install local certification, for that you should follow these steps: <br> <br>
     1. Download the latest cacert.pem from https://curl.se/ca/cacert.pem <br>
     <br>
     2. Add the following line to php.ini<br>
     `curl.cainfo="/path/to/downloaded/cacert.pem"` <br>
     please replace `/path/to/downloaded` with your own.
     <br><br>
     
### 3. run script
```shell
php script.php inputs/sample.csv
```
Note: the script first priority is get rates from api, but for any reason that can't access to online rate, it's switched to offline rate.<br>
Note: I tried to handle most condition of error or flows in the script,
you can check it with different flows like run `php script.php` or `php script.php not/exists/csv/file.csv` or any type of possible scenarios.
<br>
## How To Test Script
```shell
cd bin
phpunit ../tests
```
Note: Result of test based on the task example inputs and currency exchange rates.
<br>
<br>
