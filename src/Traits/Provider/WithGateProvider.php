<?php

namespace Raid\Core\Gate\Traits\Provider;

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
        $registeredGated = config('gate.gates', []);

        foreach ($registeredGated as $gateable => $gates) {
            foreach ($gates as $gate) {
                (new $gate($gateable))->register();
            }
        }
    }
}
