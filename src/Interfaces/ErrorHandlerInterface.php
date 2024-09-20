<?php

namespace App\Interfaces;

interface ErrorHandlerInterface
{
    public function errorHandler($errno, $errstr, $errfile, $errline):void;
    public function exceptionHandler($exception):void;
    public function shutdownHandler():void;

}