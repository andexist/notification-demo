<?php

declare(strict_types=1);

namespace App\Exception;

class MissingResourceException extends \Exception
{
    public function __construct(string $class, string $identifier)
    {
        $message = sprintf("Resource '%s' with identifier '%s' is missing", $class, $identifier);
        parent::__construct($message);
    }
}
