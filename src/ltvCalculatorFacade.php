<?php

namespace Cyborgfinance\ltvCalculator;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Cyborgfinance\ltvCalculator\ltvCalculator
 */
class ltvCalculatorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ltv_calculator_laravel';
    }
}
