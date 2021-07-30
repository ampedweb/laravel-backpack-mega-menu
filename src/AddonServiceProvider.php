<?php

namespace AmpedWeb\LaravelBackpackMegaMenu;

use Illuminate\Support\ServiceProvider;

class AddonServiceProvider extends ServiceProvider
{
    protected $path;
    protected $commands = [];

    public function __construct($app)
    {
        $this->app = $app;
        $this->path = __DIR__.'/..';
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->packageDirectoryExistsAndIsNotEmpty('bootstrap') &&
            file_exists($helpers = $this->path.'/bootstrap/helpers.php')) {
            require $helpers;
        }

        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/lang')) {
            $this->loadTranslationsFrom($this->path.'/resources/lang', 'ampedweb.laravel-backpack-mega-menu');
        }

        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/views')) {
            // Load published views
            $this->loadViewsFrom(base_path('resources/views/vendor/ampedweb/laravel-backpack-mega-menu'), 'ampedweb.laravel-backpack-mega-menu');

            // Fallback to package views
            $this->loadViewsFrom($this->path.'/resources/views', 'ampedweb.laravel-backpack-mega-menu');
        }

        if ($this->packageDirectoryExistsAndIsNotEmpty('database/migrations')) {
            $this->loadMigrationsFrom($this->path.'/database/migrations');
        }

        if ($this->packageDirectoryExistsAndIsNotEmpty('routes')) {
            $this->loadRoutesFrom($this->path.'/routes/laravel-backpack-mega-menu.php');
        }

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->packageDirectoryExistsAndIsNotEmpty('config')) {
            $this->mergeConfigFrom($this->path.'/config/laravel-backpack-mega-menu.php', 'ampedweb.laravel-backpack-mega-menu');
        }
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        if ($this->packageDirectoryExistsAndIsNotEmpty('config')) {
            $this->publishes([
                $this->path.'/config/laravel-backpack-mega-menu.php' => config_path('ampedweb/laravel-backpack-mega-menu.php'),
            ], 'config');
        }

        // Publishing the views.
        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/views')) {
            $this->publishes([
                $this->path.'/resources/views' => base_path('resources/views/vendor/ampedweb/laravel-backpack-mega-menu'),
            ], 'views');
        }

        // Publishing assets.
        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/assets')) {
            $this->publishes([
                $this->path.'/resources/assets' => public_path('packages/ampedweb/laravel-backpack-mega-menu'),
            ], 'assets');
        }

        // Publishing the translation files.
        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/lang')) {
            $this->publishes([
                $this->path.'/resources/lang' => resource_path('lang/vendor/ampedweb'),
            ], 'lang');
        }

        // Registering package commands.
        if (!empty($this->commands)) {
            $this->commands($this->commands);
        }
    }

    protected function packageDirectoryExistsAndIsNotEmpty($name)
    {
        // check if directory exists
        if (!is_dir($this->path.'/'.$name)) {
            return false;
        }

        // check if directory has files
        foreach (scandir($this->path.'/'.$name) as $file) {
            if ($file != '.' && $file != '..' && $file != '.gitkeep') {
                return true;
            }
        }

        return false;
    }
}
