<?php

use PlusTimeIT\EasyForms\Enums\DefaultHelpPositions;
use PlusTimeIT\EasyForms\Elements\Icon;

return [
    'display' => true,
    'prefix' => 'axios',
    'middleware' => 'axios',
    'form' => [
        'namespace' => 'App\Http\Forms',
        'path' => app_path('Http/Forms'),
    ],
    'defaults' => [
        'help' => [
            'position' => DefaultHelpPositions::AppendInner,
            'icon' => Icon::make()->setIcon('mdi-help'),
        ]
    ],
];
