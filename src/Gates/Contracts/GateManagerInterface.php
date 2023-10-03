<?php

namespace Raid\Core\Gate\Gates\Contracts;

interface GateManagerInterface
{
    /**
     * Define gates.
     */
    public static function defineGates(): void;

    /**
     * Get gates.
     */
    public static function getGates(): array;

    /**
     * Get registered gates.
     */
    public static function getRegisteredGates(): array;

    /**
     * Get registered gateables.
     */
    public static function getRegisteredGateables(): array;

    /**
     * Get registered gateable gates.
     */
    public static function getRegisteredGateableGates(): array;
}
