<?php

namespace Anik\Paperfly\Laravel;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class PaperflyServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function boot()
    {
        $path = realpath(__DIR__.'/config/paperfly.php');

        if ($this->app->runningInConsole() && (false === $this->isLumen())) {
            $this->publishes([
                $path => config_path('paperfly.php'),
            ]);
        }

        $this->mergeConfigFrom($path, 'paperfly');
    }

    public function register(): void
    {
        $this->registerManagers();
        $this->registerFacades();
    }

    public function provides(): array
    {
        return ['paperfly', PaperflyManager::class,];
    }

    protected function registerManagers()
    {
        $this->app->bind(PaperflyManager::class, function ($app) {
            return new PaperflyManager($app);
        });
    }

    public function registerFacades()
    {
        $this->app->bind('paperfly', function ($app) {
            return $app->make(PaperflyManager::class);
        });
    }

    protected function isLumen(): bool
    {
        return Str::contains($this->app->version(), 'Lumen');
    }
}
