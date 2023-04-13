<?php

return [
    'display' => TRUE,
    'axios-prefix' => 'axios',
    'middleware' => 'web',
    'form-namespace' => 'App\Http\Forms',
    'form-path' => app_path('Http/Forms'), // must not have trailing forward slash
    'routes' => [
        'examples' => FALSE,
        'global' => TRUE,
    ],
    'tooltip-icon' => 'mdi-help',
];
