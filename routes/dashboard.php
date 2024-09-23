<?php
return [
    'dashboard.show' => [
        'url'=>'/praktyki24-25/public/index.php?controller=dashboard&do=show',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
];
