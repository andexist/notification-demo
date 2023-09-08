<?php

declare(strict_types=1);

namespace App\Service\NotificationSender\Senders\Interface;

use App\DTO\Notification\NotificationSenderDTO;

interface SenderInterface
{
    public function send(NotificationSenderDTO $dto);
}
