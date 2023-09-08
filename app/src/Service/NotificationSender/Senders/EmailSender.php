<?php

declare(strict_types=1);

namespace App\Service\NotificationSender\Senders;

use App\DTO\Notification\NotificationSenderDTO;
use App\Service\NotificationSender\Senders\Interface\SenderInterface;

class EmailSender implements SenderInterface
{
    public function send(NotificationSenderDTO $dto)
    {
        return sprintf("Message: [%s] received via %s", $dto->getMessage()->getBody(), get_class($this));
    }   
}
