<?php

declare(strict_types=1);

namespace App\Exception\NotificationsSender;

class SenderTypeNotSupportedException extends \Exception
{
    public function __construct(string $type)
    {
        parent::__construct(sprintf("Sender type `%s` is not supported", $type));
    }
}
