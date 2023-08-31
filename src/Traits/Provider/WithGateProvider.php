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
            ], 'config');
        }
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
