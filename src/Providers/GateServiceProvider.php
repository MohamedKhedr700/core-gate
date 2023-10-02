<?php

namespace Raid\Core\Gate\Providers;

use Illuminate\Support\ServiceProvider;
use Raid\Core\Gate\Commands\CreateGateCommand;
use Raid\Core\Gate\Commands\PublishGateCommand;
use Raid\Core\Gate\Traits\Provider\WithGateProvider;

class GateServiceProvider extends ServiceProvider
{
    use WithGateProvider;

    /**
     * The commands to be registered.
     */
    protected array $commands = [
        CreateGateCommand::class,
        PublishGateCommand::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->registerHelpers();
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
