<?php

namespace Raid\Core\Gate\Gates;

use Raid\Core\Gate\Gates\Contracts\GateManagerInterface;

class GateManager implements GateManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public static function defineGates(): void
    {
        $registeredGated = static::getGates();

        foreach ($registeredGated as $gateable => $gates) {
            foreach ($gates as $gate) {
                (new $gate($gateable))->define();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getGates(): array
    {
        $registeredGates = static::getRegisteredGates();

        $registeredGateableGates = static::getRegisteredGateableGates();

        return array_merge($registeredGates, $registeredGateableGates);
    }

    /**
     * {@inheritdoc}
     */
    public static function getRegisteredGates(): array
    {
        return config('gate.gates', []);
    }

    /**
     * {@inheritdoc}
     */
    public static function getRegisteredGateables(): array
    {
        return config('gate.gateables', []);
    }

    /**
     * {@inheritdoc}
     */
    public static function getRegisteredGateableGates(): array
    {
        $registeredGateables = static::getRegisteredGateables();

        $registeredGateableGates = [];

        foreach ($registeredGateables as $gateable) {
            $gates = $gateable::getGates();

            $registeredGateableGates[$gateable] = $gates;
        }

        return $registeredGateableGates;
    }
}
