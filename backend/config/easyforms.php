<?php

return [
    'display' => true,
    'prefix' => 'axios',
    'middleware' => 'axios',
    'form' => [
        'namespace' => 'App\Http\Forms',
        'path' => app_path('Http/Forms'),
    ],
    'defaults' => [
        'tooltip-icon' => 'mdi-help',
    ],
];