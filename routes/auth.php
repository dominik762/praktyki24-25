<?php
$absolute_url = $_ENV['APP_ABSOLUTE_URL'];
return [
    'authuser.signIn' => [
        'url' => $absolute_url . '/index.php?controller=authuser&do=signIn',
        'middleware' => [],
    ],
    'authuser.signOut' => [
        'url' => $absolute_url . '/index.php?controller=authuser&do=signOut',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
    'authuser.register' => [
        'url' => $absolute_url . '/index.php?controller=authuser&do=register',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
    'authuser.login' => [
        'url' => $absolute_url . '/index.php?controller=authuser&do=login',
        'middleware' => [],
    ],
    'authuser.logout' => [
        'url' => $absolute_url . '/index.php?controller=authuser&do=logout',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
];
