<?php

return [
    /**
     * ----------------------------
     * Data Driver
     * ----------------------------
     *
     * You can choose between the following drivers: json, database
     */
    'driver' => env('FILAMENT_LOCATIONS_DRIVER', 'json'),

    /**
     * ----------------------------
     * JSON Data Path
     * ----------------------------
     *
     * The path to the JSON data file.
     */
    'json' => [
        'areas' => null,
        'cities' => null,
        'countries' => null,
        'currencies' => null,
        'languages' => null,
    ],
];
