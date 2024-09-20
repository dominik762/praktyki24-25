<?php

namespace App\Interfaces;

use Closure;

interface MiddlewareInterface
{
    public function handle(): void;

}