<?php

namespace Raid\Core\Gate\Gates\Contracts;

interface GateInterface
{
    /**
     * Get gateable class.
     */
    public function gateable(): string;

    /**
     * Get gateable actions.
     */
    public function getActions();

    /**
     * Register gate.
     */
    public function register(): void;

    /**
     * Define an action gate.
     */
    public function defineActionGate(string $actionableAction, string $action): void;
}
