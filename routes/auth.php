<?php
return [
    'authuser.signIn' => [
        'url' => '/praktyki24-25/index.php?controller=authuser&do=signIn',
        'middleware' => [],
    ],
    'authuser.signOut' => [
        'url' => '/praktyki24-25/index.php?controller=authuser&do=signOut',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
    'authuser.register' => [
        'url' => '/praktyki24-25/index.php?controller=authuser&do=register',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
    'authuser.login' => [
        'url' => '/praktyki24-25/index.php?controller=authuser&do=login',
        'middleware' => [],
    ],
    'authuser.logout' => [
        'url' => '/praktyki24-25/index.php?controller=authuser&do=logout',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
];