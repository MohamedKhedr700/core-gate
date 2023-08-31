<?php

namespace Raid\Core\Gate\Providers;

use Illuminate\Support\ServiceProvider;
use Raid\Core\Gate\Traits\Provider\WithGateProvider;

class GateServiceProvider extends ServiceProvider
{
    use WithGateProvider;

    /**
     * The commands to be registered.
     */
    protected array $commands = [];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerConfig();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerGates();
    }
}
