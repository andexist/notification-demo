<?php 

declare(strict_types=1);

namespace App\Service\NotificationSender;

use App\DTO\Notification\NotificationSenderDTO;
use App\Service\NotificationSender\Config\NotificationSenderConfig;

class NotificationSenderService extends AbstractNotificationSender
{
    public function __construct(private NotificationSenderConfig $senderConfig)
    {}

    public function send(NotificationSenderDTO $dto)
    {
        $sender = $this->senderConfig->getSenderClass($dto->getSenderType());

        return $sender->send($dto);
    }
}
