<?php

namespace Raid\Core\Gate\Gates;

use Illuminate\Support\Facades\Gate as IlluminateGate;
use Raid\Core\Gate\Gates\Contracts\GateInterface;

abstract class Gate implements GateInterface
{
    /**
     * Gate methods.
     */
    public const METHODS = [];

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
    public static function methods(): array
    {
        return static::METHODS;
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
    public function getGateableMethod(string $method): string
    {
        return $this->gateableName().'.'.$method;
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        foreach (static::methods() as $method) {
            $this->defineGateMethod($method);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function defineGateMethod(string $method): void
    {
        $gateableMethod = $this->getGateableMethod($method);

        if (! method_exists($this, $method)) {
            return;
        }

        IlluminateGate::define($gateableMethod, [static::class, $method]);
    }
}
