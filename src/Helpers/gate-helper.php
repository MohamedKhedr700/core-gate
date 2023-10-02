<?php


use Raid\Core\Gate\Gates\Contracts\GateableInterface;

if (! function_exists('gatable')) {
    /**
     * Get gatable instance.
     */
    function gatable(string $gatable = '', string $action = '', array $data = []): GateableInterface
    {
        $gatableManager = app(GateableInterface::class, ['gatable' => $gatable]);

        if ($action) {
            $gatableManager->setAction($action);
        }

        if ($data) {
            $gatableManager->authorize($action, ...$data);
        }

        return $gatableManager;
    }
}
