<?php

return [
    'paths' => [
        resource_path('views'),
    ],

    'compiled' => env('VIEW_CACHE_PATH') ?: storage_path('framework/views'),
];
