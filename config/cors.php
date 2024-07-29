<?php

return [
    'paths' => ['*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:8080'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // or specify the headers you allow
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
