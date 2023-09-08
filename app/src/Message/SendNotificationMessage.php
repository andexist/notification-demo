<?php

declare(strict_types=1);

namespace App\Message;

use App\DTO\Notification\NotificationSenderDTO;

final class SendNotificationMessage
{
    public function __construct(private NotificationSenderDTO $dto)
    {}

    public function getNotificationSenderDto(): NotificationSenderDTO
    {
        return $this->dto;
    }
}
