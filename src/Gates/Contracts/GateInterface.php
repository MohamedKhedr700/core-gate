<?php

namespace Raid\Core\Gate\Gates\Contracts;

interface GateInterface
{
    /**
     * Get gate methods.
     */
    public static function methods(): array;

    /**
     * Get gateable class.
     */
    public function gateable(): string;

    /**
     * Get gateable name.
     */
    public function gateableName(): string;

    /**
     * Get gateable method.
     */
    public function getGateableMethod(string $method): string;

    /**
     * Register gate.
     */
    public function register(): void;

    /**
     * Define gate method.
     */
    public function defineGateMethod(string $method): void;
}
