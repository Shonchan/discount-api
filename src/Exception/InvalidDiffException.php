<?php

namespace App\Exception;

class InvalidDiffException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Invalid date difference");
    }
}