<?php

namespace Raid\Core\Gate\Traits\Provider;

use Raid\Core\Gate\Actions\Contracts\ActionInterface;

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
        $gates = config('gate.gates', []);

        foreach ($gates as $gateable => $gates) {
            foreach ($gates as $gate) {
                (new $gate($gateable))->register();
            }
        }
    }
}
