<?php

namespace App;

class GlobalErrorAndExceptionHandler
{

    public static function errorHandler($errno, $errstr, $errfile, $errline): void
    {
        echo "<b>Error:</b> [$errno] $errstr in $errfile in line $errline<br>";
        Logger::getInstance()->error("[$errno] $errstr in $errfile in line $errline");
    }

    public static function exceptionHandler($exception): void
    {
        echo "<b>Exception:</b> . $exception . <br>";
        echo "In file: " . $exception->getFile() . " in line " . $exception->getLine() . "<br>";
        Logger::getInstance()->error($exception->getMessage());
    }
    public static function shutdownHandler(): void
    {
        $error = error_get_last();

        if ($error && ($error['type'] === E_ERROR || $error['type'] === E_PARSE || $error['type'] === E_CORE_ERROR || $error['type'] === E_COMPILE_ERROR)) {
            if (ini_get('display_errors')) {
                echo "<b>Fatal error:</b> " . $error['message'] . " in " . $error['file'] . " on line " . $error['line'] . "<br>";
                Logger::getInstance()->error($error['message']);
            }
        }
    }

}