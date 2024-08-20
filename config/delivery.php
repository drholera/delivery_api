<?php

return [
    'debug' => env('DELIVERY_DEBUG', false),
    'novaposhta' => [
        'base_url' => 'https://novaposhta.test/api/delivery'
    ],
    'ukrposhta' => [
        'base_url' => 'https://ukrposhta.test/api/delivery'
    ]
];
