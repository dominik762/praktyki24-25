<?php
$absolute_url = $_ENV['APP_ABSOLUTE_URL'];
return [
    'dashboard.show' => [
        'url' => $absolute_url . '/index.php?controller=dashboard&do=show',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
];

