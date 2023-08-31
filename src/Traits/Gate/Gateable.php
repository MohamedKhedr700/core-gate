<?php

namespace Raid\Core\Gate\Traits\Gate;

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
    public static function getGates(): array
    {
        return config('gate.gates.'.static::class, []);
    }
}
