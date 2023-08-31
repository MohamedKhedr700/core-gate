<?php

namespace Raid\Core\Gate\Gates;

use Illuminate\Support\Facades\Gate as GateFacade;
use Illuminate\Support\Str;
use Raid\Core\Gate\Gates\Contracts\GateInterface;

abstract class Gate implements GateInterface
{
    /**
     * Gateable class.
     */
    private string $gateable;

    /**
     * Create a new gate instance.
     */
    public function __construct(string $gateable)
    {
        $this->gateable = $gateable;
    }

    /**
     * {@inheritdoc}
     */
    public function gateable(): string
    {
        return $this->gateable;
    }

    /**
     * {@inheritdoc}
     */
    public function getActions()
    {
        return $this->gateable()::getActions();
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $actionableActions = $this->getActions();

        foreach ($actionableActions as $action) {
            $this->defineActionGate($action::getAction(), $action::action());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function defineActionGate(string $actionableAction, string $action): void
    {
        $method = Str::camel($action);

        if (! method_exists($this, $method)) {
            return;
        }

        GateFacade::define($actionableAction, function ($account, ...$arguments) use ($method) {
            return $this->{$method}($account, ...$arguments);
        });
    }
}
