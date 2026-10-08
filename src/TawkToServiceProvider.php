<?php

namespace JeffersonGoncalves\TawkTo;

use Illuminate\Support\Facades\Config;
use JeffersonGoncalves\TawkTo\Settings\TawkToSettings;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TawkToServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-tawk-to')
            ->hasViews();
    }

    public function packageRegistered(): void
    {
        parent::packageRegistered();

        Config::set('settings.settings', array_merge(
            Config::get('settings.settings', []),
            [TawkToSettings::class]
        ));
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        $settingsMigrationsPath = __DIR__.'/../database/settings';

        Config::set('settings.migrations_paths', array_merge(
            [$settingsMigrationsPath],
            Config::get('settings.migrations_paths', [])
        ));

        $this->publishes([
            $settingsMigrationsPath => database_path('settings'),
        ], 'tawk-to-settings-migrations');
    }
}
