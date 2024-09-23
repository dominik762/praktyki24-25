<?php

namespace App\Interfaces;

interface ErrorHandlerInterface
{
    public function errorHandler(int $errno,string $errstr,string $errfile,int $errline):void;
    public function exceptionHandler($exception):void;
    public function shutdownHandler():void;

}