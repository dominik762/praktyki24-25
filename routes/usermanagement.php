<?php
$absolute_url = $_ENV['APP_ABSOLUTE_URL'];
return [
    'usermanagement.show' => [
        'url' => $absolute_url . '/index.php?controller=usermanagement&do=show',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
    'usermanagement.showAll' => [
        'url' => $absolute_url . '/index.php?controller=usermanagement&do=showAll',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
    'usermanagement.create' => [
        'url' => $absolute_url . '/index.php?controller=usermanagement&do=create',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
    'usermanagement.editForm' => [
        'url' => $absolute_url . '/index.php?controller=usermanagement&do=editForm',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
    'usermanagement.edit' => [
        'url' => $absolute_url . '/index.php?controller=usermanagement&do=edit',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
    'usermanagement.delete' => [
        'url' => $absolute_url . '/index.php?controller=usermanagement&do=delete',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
    ],
];
