<?php

namespace Raid\Core\Gate\Gates\Contracts\Concerns;

interface GateableInterface
{
    /**
     * Get gateable class.
     */
    public function gateable(): string;

    /**
     * Get gateable name.
     */
    public static function gateableName(): string;

    /**
     * Get gateable actions.
     */
    public static function getGates(): array;
}
