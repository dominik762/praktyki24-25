<?php
return [
    'dashboard.show' => [
        'url'=>'/praktyki24-25/index.php?controller=dashboard&do=show',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
];
