<?php


use Raid\Core\Gate\Gates\Contracts\GateableInterface;

if (! function_exists('gatable')) {
    /**
     * Get gatable instance.
     */
    function gatable(string $gatable = '', string $action = '', ...$arguments): GateableInterface
    {
        $gatableManager = app(GateableInterface::class, ['gatable' => $gatable]);

        if ($action) {
            $gatableManager->setAction($action);
        }

        if ($arguments) {
            $gatableManager->authorize($action, ...$arguments);
        }

        return $gatableManager;
    }
}
