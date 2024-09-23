<?php

namespace App\Controllers;

use App\View;

class DashboardController
{
    public function show(): void
    {
        View::render('dashboard', [
            'title' => 'Dashboard',
            'absolute_url'=>$_ENV['APP_ABSOLUTE_URL'],
        ]);
    }

}