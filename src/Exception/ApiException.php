<?php


namespace App\Exception;


use Throwable;

class ApiException extends \RuntimeException
{
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}