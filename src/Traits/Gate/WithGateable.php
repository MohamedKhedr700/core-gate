<?php

namespace Raid\Core\Gate\Traits\Gate;

trait WithGateable
{
    /**
     * Gatable class name.
     */
    protected string $gatable;

    /**
     * Get gatable class name.
     */
    public function gatable(): string
    {
        return $this->gatable;
    }

    /**
     * Get gatable name.
     */
    public function gatableName(): string
    {
        return $this->gatable()::gateableName();
    }
}
