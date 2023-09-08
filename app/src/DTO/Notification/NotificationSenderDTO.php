<?php

declare(strict_types=1);

namespace App\DTO\Notification;

use App\Model\Message;

class NotificationSenderDTO
{
    public function __construct(
        private string $senderType,
        private string $email,
        private string $phoneNumber,
        private Message $message,
    )
    {}

    public function getSenderType(): string
    {
        return $this->senderType;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }
}
