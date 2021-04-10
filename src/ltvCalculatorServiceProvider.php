<?php

namespace Cyborgfinance\ltvCalculator;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Cyborgfinance\ltvCalculator\Commands\ltvCalculatorCommand;

class ltvCalculatorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('ltv_calculator_laravel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_ltv_calculator_laravel_table')
            ->hasCommand(ltvCalculatorCommand::class);
    }
}
