<?php

namespace Raid\Core\Gate\Gates;

use Illuminate\Support\Facades\Gate;
use Raid\Core\Gate\Gates\Contracts\GateableInterface;
use Raid\Core\Gate\Traits\Gate\WithGateable;
use Raid\Core\Gate\Traits\Gate\WithGateableAction;

class Gateable implements GateableInterface
{
    use WithGateable,
        WithGateableAction;

    /**
     * Create a new gatable instance.
     */
    public function __construct(string $gatable)
    {
        $this->gatable = $gatable;
    }

    /**
     * Authorize the given action for the given gateable.
     */
    public function authorize(string $action, ...$arguments): GateableInterface
    {
        $this->setAction($action);

        $actions = $this->parseAction($action);

        foreach ($actions as $action) {
            $this->authorizeAction($action, $arguments);
        }

        return $this;
    }
}