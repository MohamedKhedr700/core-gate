<?php

namespace Raid\Core\Gate\Traits\Gate;

use Illuminate\Support\Facades\Gate;

trait WithGateableAction
{
    /**
     * Gate action.
     */
    protected string $action = '';

    /**
     * Set gate action.
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function action(): string
    {
        return $this->action;
    }

    /**
     * Parse the given action.
     */
    public function parseAction(string $action): array
    {
        $actions = array_values(array_filter(explode(' ', $action)));

        foreach ($actions as &$action) {
            $action = $this->gatableName().'.'.$action;
        }

        return $actions;
    }

    /**
     * Authorize the given action for the given gateable.
     */
    public function authorizeAction(string $action, array $arguments): void
    {
        Gate::authorize($action, ...$arguments);
    }
}