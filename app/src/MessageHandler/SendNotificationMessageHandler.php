<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\SendNotificationMessage;
use App\Service\NotificationSender\NotificationSenderService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendNotificationMessageHandler
{
    public function __construct(private NotificationSenderService $notificationSenderService)
    {}

    public function __invoke(SendNotificationMessage $message)
    {
        $this->notificationSenderService->send($message->getNotificationSenderDto());
    }
}
