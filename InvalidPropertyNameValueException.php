<?php

declare(strict_types=1);

class InvalidPropertyNameException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
