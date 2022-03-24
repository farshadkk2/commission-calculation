
# Commission Calculation task

## How To Run

### 1. Install dependencies:

```shell  
composer install
```  

### 2. Install PHP requirements extensions and certification

#### Currency Exchange Rates API
if you want to use online rates provided by https://developers.paysera.com/tasks/api/currency-exchange-rates, you should have `openssl` and `curl` extension installed in your PHP.  
By default, if the system couldn't access to API for any reason, switched to default currency exchange rates that define in `config/rates.php`.<br>  
Already in an offline mode, these rates are saved from task sample rates given.
#### SSL Certificate Problem:<br>
if you get the following error when running the script:
`SSL peer certificate or SSH remote key was not OK: SSL certificate problem: unable to get local issuer certificate`  
you should install local certification. <br>  <br>  
For that, you should follow these steps: <br>
1. Download the latest cacert.pem from https://curl.se/ca/cacert.pem <br>     <br>
2. Add the following line to php.ini<br>  
   `curl.cainfo="/path/to/downloaded/cacert.pem"` <br>  
   please replace `/path/to/downloaded` with your own.  
   <br><br>

### 3. Run Script
```shell  
php script.php inputs/sample.csv
```  
<p>  
Note: the script first priority is get rates from api, but for any reason that can't access to online rate, it's switched to offline rate.<br>  
</p>  
<p>  
Note: I tried to handle most condition of error or flows in the script,  
you can check it with different flows like run  
`php script.php` or `php script.php not/exists/csv/file.csv` or any type of possible scenarios.  
</p>  

## How To Test Script
```shell  
cd binphpunit ../tests
```  
<p>  
Note: Result of test based on the task example inputs and currency exchange rates.  
</p>  
<br>