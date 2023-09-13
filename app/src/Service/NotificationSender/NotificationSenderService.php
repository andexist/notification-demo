<?php 

declare(strict_types=1);

namespace App\Service\NotificationSender;

use App\DTO\Notification\NotificationSenderDTO;
use App\Service\NotificationSender\Factory\NotificationSenderFactory;

class NotificationSenderService extends AbstractNotificationSender
{
    public function __construct(private NotificationSenderFactory $senderFactory)
    {}

    public function send(NotificationSenderDTO $dto)
    {
        $sender = $this->senderFactory->getSenderClass($dto->getSenderType());

        return $sender->send($dto);
    }
}
