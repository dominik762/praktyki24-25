<?php

namespace App;

class AppMode
{
    public static function setAppMode($mode)
    {
        if ($mode == 'dev') {
            set_error_handler([GlobalErrorAndExceptionHandler::class, 'errorHandler']);
            set_exception_handler([GlobalErrorAndExceptionHandler::class, 'exceptionHandler']);
            register_shutdown_function([GlobalErrorAndExceptionHandler::class, 'shutdownHandler']);
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }
        else {
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            error_reporting(0);

            set_error_handler(function ($errno, $errstr, $errfile, $errline) {
                Logger::getInstance()->error("[$errno] $errstr in $errfile on line $errline");
            });
            set_exception_handler(function ($exception) {
                Logger::getInstance()->error("Error: $exception->getMessage()" . "in $exception->getFile():" . "on line $exception->getLine()");
            });
            register_shutdown_function(function () {
                $error = error_get_last();

                if ($error && ($error['type'] === E_ERROR || $error['type'] === E_PARSE || $error['type'] === E_CORE_ERROR || $error['type'] === E_COMPILE_ERROR)) {
                    if (ini_get('display_errors')) {
                        Logger::getInstance()->error($error['message']);
                    }
                }
            });
        }

    }
}