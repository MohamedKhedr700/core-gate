<?php

namespace Raid\Core\Gate\Gates\Contracts;

interface GateInterface
{
    /**
     * Get gate actions.
     */
    public static function actions(): array;

    /**
     * Get gateable class.
     */
    public function gateable(): string;

    /**
     * Get gateable name.
     */
    public function gateableName(): string;

    /**
     * Get gateable action.
     */
    public function getGateableAction(string $action): string;

    /**
     * Define gate.
     */
    public function define(): void;

    /**
     * Define action method.
     */
    public function defineActionMethod(string $action): void;
}
