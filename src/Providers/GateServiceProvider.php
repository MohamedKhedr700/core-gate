<?php

namespace Raid\Core\Gate\Providers;

use Illuminate\Support\ServiceProvider;
use Raid\Core\Gate\Commands\PublishCommand;
use Raid\Core\Gate\Traits\Provider\WithGateProvider;

class GateServiceProvider extends ServiceProvider
{
    use WithGateProvider;

    /**
     * The commands to be registered.
     */
    protected array $commands = [
        PublishCommand::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->registerCommands();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerGates();
    }
}
