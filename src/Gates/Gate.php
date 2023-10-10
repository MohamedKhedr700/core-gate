<?php

namespace Raid\Core\Gate\Gates;

use Illuminate\Support\Facades\Gate as IlluminateGate;
use Illuminate\Support\Str;
use Raid\Core\Gate\Gates\Contracts\GateInterface;

abstract class Gate implements GateInterface
{
    /**
     * Gate actions.
     */
    public const ACTIONS = [];

    /**
     * Gateable class.
     */
    protected string $gateable;

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
    public static function actions(): array
    {
        return static::ACTIONS;
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
    public function gateableName(): string
    {
        return $this->gateable()::gateableName();
    }

    /**
     * {@inheritdoc}
     */
    public function getGateableAction(string $action): string
    {
        return $this->gateableName().'.'.$action;
    }

    /**
     * {@inheritdoc}
     */
    public function define(): void
    {
        foreach (static::actions() as $action) {
            $this->defineActionMethod($action);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function defineActionMethod(string $action): void
    {
        $method = Str::camel($action);

        if (! method_exists($this, $method)) {
            return;
        }

        $gateableAction = $this->getGateableAction($action);

        IlluminateGate::define($gateableAction, function ($account, ...$arguments) use ($method) {
            return $this->{$method}($account, ...$arguments);
        });

        //        IlluminateGate::define($gateableMethod, [static::class, $method]);
    }
}
