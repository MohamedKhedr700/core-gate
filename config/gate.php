<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Gate Manager
    |--------------------------------------------------------------------------
    | Here you can define the gate manager that will be used in the application.
    |
    */

    'gate_manager' => \Raid\Core\Gate\Gates\GateManager::class,

    /*
    |--------------------------------------------------------------------------
    | Gateable Manager
    |--------------------------------------------------------------------------
    | Here you can define the gateable manager that will be used in the application.
    |
    */

    'gateable_manager' => \Raid\Core\Gate\Gates\Gateable::class,

    /*
    |--------------------------------------------------------------------------
    | Gateables
    |--------------------------------------------------------------------------
    | Here you can define the gateables that will be used in the application.
    | The gates must be defined in the following format:
    |
    | gateable::class,
    |
    */

    'gateables' => [],

    /*
    |--------------------------------------------------------------------------
    | Gates
    |--------------------------------------------------------------------------
    | Here you can define the gates that will be used in the application.
    | The gates must be defined in the following format:
    |
    | gateable::class => [
    |     gate::class,
    | ],
    |
    */

    'gates' => [],
];
