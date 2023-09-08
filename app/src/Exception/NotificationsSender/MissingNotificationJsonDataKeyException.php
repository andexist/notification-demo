<?php

declare(strict_types=1);

namespace App\Exception\NotificationsSender;

class MissingNotificationJsonDataKeyException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Not valid message format, missing `body` parameter.");
    }
}
