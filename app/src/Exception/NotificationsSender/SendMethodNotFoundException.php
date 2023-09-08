<?php

declare(strict_types=1);

namespace App\Exception\NotificationsSender;

class SendMethodNotFoundException extends \Exception
{
    public function __construct(string $class)
    {
        parent::__construct(sprintf("The 'send' method is not found in the: %s", $class));
    }
}
