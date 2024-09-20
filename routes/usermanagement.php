<?php
return [
    'usermanagement.show' => [
        'url'=>'/praktyki24-25/public/index.php?controller=usermanagement&do=show',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
        ],
    'usermanagement.showAll' => [
        'url'=>'/praktyki24-25/public/index.php?controller=usermanagement&do=showAll',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
        ],
    'usermanagement.create' => [
        'url'=>'/praktyki24-25/public/index.php?controller=usermanagement&do=create',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
        ],
    'usermanagement.editForm' => [
        'url'=>'/praktyki24-25/public/index.php?controller=usermanagement&do=editForm',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
        ],
    'usermanagement.edit' => [
        'url'=>'/praktyki24-25/public/index.php?controller=usermanagement&do=edit',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
        ],
    'usermanagement.delete' => [
        'url'=>'/praktyki24-25/public/index.php?controller=usermanagement&do=delete',
        'middleware' => [\App\Middleware\EnsureUserIsLoggedInMiddleware::class],
        ],
];

