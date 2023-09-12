<?php

declare(strict_types=1);

namespace App\Service\NotificationSender\Config;

use App\Exception\NotificationsSender\SenderClassNotFoundException;
use App\Exception\NotificationsSender\SenderTypeNotSupportedException;
use App\Exception\NotificationsSender\SendMethodNotFoundException;
use App\Service\NotificationSender\Senders\SMSSender;
use App\Service\NotificationSender\Senders\EmailSender;

class NotificationSenderConfig
{
    public static $allowedSenders = [
        'sms' => SMSSender::class,
        'email' => EmailSender::class,
    ];

    public function getSenderClass(string $senderType): object
    {
        $sender = $this->supportedSender($senderType);

        if (class_exists($sender)) {
            if(method_exists(new $sender(), 'send')) {
                return new $sender(); 
            }

            throw new SendMethodNotFoundException($sender);
        }

        throw new SenderClassNotFoundException($sender);
    }

    public function supportedSender(string $senderType): string
    {
        if (isset(self::$allowedSenders[$senderType])) {
            return self::$allowedSenders[$senderType];
        }

        throw new SenderTypeNotSupportedException($senderType); 
    }
}
