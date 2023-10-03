<?php

namespace Raid\Core\Gate\Traits\Provider;

use Raid\Core\Gate\Gates\Contracts\GateableInterface;
use Raid\Core\Gate\Gates\Contracts\GateManagerInterface;

trait WithGateProvider
{
    /**
     * Register config.
     */
    private function registerConfig(): void
    {
        $configResourcePath = glob(__DIR__.'/../../../config/*.php');

        foreach ($configResourcePath as $config) {

            $this->publishes([
                $config => config_path(basename($config)),
            ], 'config-gate');
        }
    }

    /**
     * Register helpers.
     */
    private function registerHelpers(): void
    {
        $helpers = glob(__DIR__.'/../../Helpers/*.php');

        foreach ($helpers as $helper) {
            require_once $helper;
        }
    }

    /**
     * Register helpers.
     */
    private function registerCommands(): void
    {
        $this->commands($this->commands);
    }

    /**
     * Register gates.
     */
    private function registerGates(): void
    {
        $this->registerGateManager();
        $this->registerGateableManager();
        $this->registerGateableGates();
    }


    /**
     * Register gate manager.
     */
    private function registerGateManager(): void
    {
//        $gateManager = config('gate.gate_manager');
//
//        if (is_null($gateManager)) {
//            return;
//        }

        $this->app->singleton(GateManagerInterface::class, config('gate.gate_manager'));
    }

    /**
     * Register gateable manager.
     */
    private function registerGateableManager(): void
    {
//        $gateableManager = config('gate.gateable_manager');

        if (is_null($gateableManager)) {
            return;
        }

        $this->app->bind(GateableInterface::class, config('gate.gateable_manager'));
    }

    /**
     * Register gateable gates.
     */
    private function registerGateableGates(): void
    {
        if (is_null(config('gate.gate_manager'))) {
            return;
        }

        $gateManager = app(GateManagerInterface::class);

        $gateManager::defineGates();
    }
}
