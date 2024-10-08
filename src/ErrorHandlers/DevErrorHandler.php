<?php

namespace App\ErrorHandlers;

use App\Interfaces\ErrorHandlerInterface;
use App\Logger;

class DevErrorHandler implements ErrorHandlerInterface
{

    public function errorHandler(int $errno,string $errstr,string $errfile,int $errline): void
    {
        Logger::getInstance()->error("[$errno] $errstr in $errfile in line $errline");
        echo "Error occurred: [$errno] $errstr in $errfile on line $errline<br>";
    }

    public function exceptionHandler($exception): void
    {
        $errno = $exception->getCode();
        $errstr = $exception->getMessage();
        $errfile = $exception->getFile();
        $errline = $exception->getLine();

        Logger::getInstance()->error("[$errno] $errstr in $errfile on line $errline");
        echo "Exception occurred: [$errno] $errstr in $errfile on line $errline<br>";
    }

    public function shutdownHandler(): void
    {
        $error = error_get_last();

        if ($error && ($error['type'] === E_ERROR || $error['type'] === E_PARSE || $error['type'] === E_CORE_ERROR || $error['type'] === E_COMPILE_ERROR)) {
            if (ini_get('display_errors')) {
                Logger::getInstance()->error($error['message']);
                echo "Fatal error occurred: " . $error['message'] . "<br>";
            }
        }
    }

}