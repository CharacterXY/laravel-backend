<?php
return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Omogući CORS za API rute

    'allowed_methods' => ['*'], // Omogući sve HTTP metode

    'allowed_origins' => ['*', ], // Omogući sve domene (ili specificiraj domene)

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Omogući sve zaglavlja

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false, // Postavi na true ako koristiš kolačiće
];