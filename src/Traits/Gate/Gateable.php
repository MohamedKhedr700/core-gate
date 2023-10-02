<?php

namespace Raid\Core\Gate\Traits\Gate;

use Raid\Core\Gate\Gates\Contracts\GateableInterface;

trait Gateable
{
    /**
     * Get gateable.
     */
    public static function gateable(): string
    {
        return static::class;
    }

    /**
     * Get gateable name.
     */
    public static function gateableName(): string
    {
        return strtolower(class_basename(static::gateable()));
    }

    /**
     * Get gateable actions.
     */
    public static function gates(string $action = null, ...$data): GateableInterface
    {
        return gatable(static::gateable(), $action, $data);
    }

    /**
     * Get gateable actions.
     */
    public static function getGates(): array
    {
        return config('gate.gates.'.static::class, []);
    }
}
