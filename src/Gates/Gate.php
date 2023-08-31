<?php

namespace Raid\Core\Gate\Gates;

use Illuminate\Support\Facades\Gate as GateFacade;
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
    public function gateableName(): string
    {
        return $this->gateable()::gateableName();
    }

    /**
     * {@inheritdoc}
     */
    public function getGateMethods(): array
    {
        $methods = get_class_methods($this);

        $parentMethods = get_class_methods(self::class);

        return array_diff($methods, $parentMethods);
    }

    /**
     * {@inheritdoc}
     */
    public function getGateableMethod(string $method): string
    {
        return $this->gateableName() . '.' . $method;
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $methods = $this->getGateMethods();

        foreach ($methods as $method) {
            $this->defineGateMethod($method);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function defineGateMethod(string $method): void
    {
        $gateableMethod = $this->getGateableMethod($method);

        GateFacade::define($gateableMethod, function ($account, ...$arguments) use ($method) {
            return $this->{$method}($account, ...$arguments);
        });
    }
}
