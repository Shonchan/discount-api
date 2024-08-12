<?php

namespace App\Exception;

class InvalidAgeException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Invalid customer age");
    }
}