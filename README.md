# Loan to Value (LTV) Calculator for Laravel.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cyborgfinance/ltv_calculator_laravel.svg?style=flat-square)](https://packagist.org/packages/cyborgfinance/ltv_calculator_laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/cyborgfinance/ltv_calculator_laravel.svg?style=flat-square)](https://packagist.org/packages/cyborgfinance/ltv_calculator_laravel)

Loan to Value (LTV) Calculator for Laravel.


## Installation

You can install the package via composer:

```bash
composer require cyborgfinance/ltv-calculator-laravel
```

## Usage

```php
namespace App\Http\Controllers;

use Cyborgfinance\ltvCalculator\ltvCalculator;

class Testing extends Controller
{

  public function __invoke()
  {

    $ltvCalculator = new ltvCalculator();
    $output = $ltvCalculator->setValue(200)->setDeposit(100)->calculate();

    dd($output);
  }
}
```

### Other Methods

Useing many variations of 2 of the 4 variables (value, deposit, loan, ltv) you can calculate the remaining 2.

```php
//Calculate from Value & Deposit
$ltvCalculator = new ltvCalculator();
$output = $ltvCalculator->setValue(200000)->setDeposit(150000)->calculate();
```
```php
//Calculate from Value & Loan
$ltvCalculator = new ltvCalculator();
$output = $ltvCalculator->setValue(200000)->setLoan(50000)->calculate();
```
```php
//Calculate from Value & LTV
$ltvCalculator = new ltvCalculator();
$output = $ltvCalculator->setValue(200000)->setLtv(75)->calculate();
```
```php
//Calculate from Loan & LTV
$ltvCalculator = new ltvCalculator();
$output = $ltvCalculator->setLoan(5000)->setLtv(75)->calculate();
```
```php
//Calculate from Deposit & LTV
$ltvCalculator = new ltvCalculator();
$output = $ltvCalculator->setDeposit(50000)->setLtv(75)->calculate();
```
The output all all of the above examples is:
```bash
array:5 [
  "value" => 200000.0
  "deposit" => 150000.0
  "loan" => 50000.0
  "ltv" => 75.0
  "dtv" => 25.0
]
```

### List of Setters
```php
$ltvCalculator = new ltvCalculator();
//List of Setters
//You only need 2 out of 4, to calculate the remaining.
$ltvCalculator->setValue($value);
$ltvCalculator->setDeposit($value);
$ltvCalculator->setLoan($value);
$ltvCalculator->setLtv($value);
```



## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- Cyborg Finance [GitHub](https://github.com/CyborgFinance), [Website](https://cyborg.finance) & [Twitter](https://twitter.com/cyborgfinance)
- Adam Hosker [GitHub](https://github.com/ahosker), [Website](https://hosker.info) & [Twitter](https://twitter.com/adam_hosker)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
