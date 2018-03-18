<?php

namespace Bantenprov\PerijinanSatuPintu;

use Illuminate\Support\ServiceProvider;
use Bantenprov\PerijinanSatuPintu\Console\Commands\PerijinanSatuPintuCommand;

/**
 * The PerijinanSatuPintuServiceProvider class
 *
 * @package Bantenprov\PerijinanSatuPintu
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class PerijinanSatuPintuServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->routeHandle();
        $this->configHandle();
        $this->langHandle();
        $this->viewHandle();
        $this->assetHandle();
        $this->migrationHandle();
        $this->publicHandle();
        $this->seedHandle();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('perijinan-satu-pintu', function ($app) {
            return new PerijinanSatuPintu;
        });

        $this->app->singleton('command.perijinan-satu-pintu', function ($app) {
            return new PerijinanSatuPintuCommand;
        });

        $this->commands('command.perijinan-satu-pintu');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'perijinan-satu-pintu',
            'command.perijinan-satu-pintu',
        ];
    }

    /**
     * Loading and publishing package's config
     *
     * @return void
     */
    protected function configHandle()
    {
        $packageConfigPath = __DIR__.'/config/config.php';
        $appConfigPath     = config_path('perijinan-satu-pintu.php');

        $this->mergeConfigFrom($packageConfigPath, 'perijinan-satu-pintu');

        $this->publishes([
            $packageConfigPath => $appConfigPath,
        ], 'perijinan-satu-pintu-config');
    }

    /**
     * Loading package routes
     *
     * @return void
     */
    protected function routeHandle()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
    }

    /**
     * Loading and publishing package's translations
     *
     * @return void
     */
    protected function langHandle()
    {
        $packageTranslationsPath = __DIR__.'/resources/lang';

        $this->loadTranslationsFrom($packageTranslationsPath, 'perijinan-satu-pintu');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/perijinan-satu-pintu'),
        ], 'perijinan-satu-pintu-lang');
    }

    /**
     * Loading and publishing package's views
     *
     * @return void
     */
    protected function viewHandle()
    {
        $packageViewsPath = __DIR__.'/resources/views';

        $this->loadViewsFrom($packageViewsPath, 'perijinan-satu-pintu');

        $this->publishes([
            $packageViewsPath => resource_path('views/vendor/perijinan-satu-pintu'),
        ], 'perijinan-satu-pintu-views');
    }

    /**
     * Publishing package's assets (JavaScript, CSS, images...)
     *
     * @return void
     */
    protected function assetHandle()
    {
        $packageAssetsPath = __DIR__.'/resources/assets';

        $this->publishes([
            $packageAssetsPath => resource_path('assets'),
        ], 'perijinan-satu-pintu-assets');
    }

    /**
     * Publishing package's migrations
     *
     * @return void
     */
    protected function migrationHandle()
    {
        $packageMigrationsPath = __DIR__.'/database/migrations';

        $this->loadMigrationsFrom($packageMigrationsPath);

        $this->publishes([
            $packageMigrationsPath => database_path('migrations')
        ], 'perijinan-satu-pintu-migrations');
    }

    public function publicHandle()
    {
        $packagePublicPath = __DIR__.'/public';

        $this->publishes([
            $packagePublicPath => base_path('public')
        ], 'perijinan-satu-pintu-public');
    }

    public function seedHandle()
    {
        $packageSeedPath = __DIR__.'/database/seeds';

        $this->publishes([
            $packageSeedPath => base_path('database/seeds')
        ], 'perijinan-satu-pintu-seeds');
    }
}
