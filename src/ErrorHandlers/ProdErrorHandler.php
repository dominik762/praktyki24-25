<?php

namespace App\ErrorHandlers;

use App\Logger;

class ProdErrorHandler
{
    public function errorHandler($errno, $errstr, $errfile, $errline): void
    {
        Logger::getInstance()->error("[$errno] $errstr in $errfile in line $errline");
    }

    public function exceptionHandler($exception): void
    {
        Logger::getInstance()->error($exception->getMessage());
    }

    public function shutdownHandler(): void
    {
        $error = error_get_last();

        if ($error && ($error['type'] === E_ERROR || $error['type'] === E_PARSE || $error['type'] === E_CORE_ERROR || $error['type'] === E_COMPILE_ERROR)) {
            if (ini_get('display_errors')) {
                Logger::getInstance()->error($error['message']);
            }
        }
    }

}