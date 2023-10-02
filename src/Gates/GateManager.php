<?php

namespace Raid\Core\Gate\Gates;

class GateManager
{
    /**
     * Register gates.
     */
    public static function registerGates(): void
    {
        $registeredGated = static::getRegisteredGates();

        foreach ($registeredGated as $gateable => $gates) {
            foreach ($gates as $gate) {
                (new $gate($gateable))->register();
            }
        }
    }

    /**
     * Get registered gates.
     */
    public static function getRegisteredGates(): array
    {
        return config('gate.gates', []);
    }
}