<?php

declare(strict_types=1);

namespace App\Exception\NotificationsSender;

class SenderClassNotFoundException extends \Exception
{
    public function __construct(string $class)
    {
        parent::__construct(sprintf("Sender class not found: `%s`", $class));
    }
}
