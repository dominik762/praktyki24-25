<?php

namespace App\Controllers;

use App\View;

class DashboardController
{
    public function show()
    {
        echo View::render('dashboard', [
            'title' => 'Dashboard',
        ]);
    }

}