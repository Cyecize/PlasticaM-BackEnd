<?php

namespace App\Service;

interface LogService
{
    /**
     * @param string $location
     * @param string $message
     */
    public function log(string $location, string $message): void;

}