<?php

declare(strict_types=1);

namespace App\Service\NotificationSender;

use App\DTO\Notification\NotificationSenderDTO;

abstract class AbstractNotificationSender
{
    abstract function send(NotificationSenderDTO $dto);
}
