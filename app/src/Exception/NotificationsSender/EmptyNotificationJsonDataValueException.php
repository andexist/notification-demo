<?php

declare(strict_types=1);

namespace App\Exception\NotificationsSender;

class EmptyNotificationJsonDataValueException extends \Exception
{
    public function __construct()
    {
        parent::__construct("The `body` field cannot be empty.");
    }
}
