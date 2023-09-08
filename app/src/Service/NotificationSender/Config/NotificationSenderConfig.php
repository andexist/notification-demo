<?php

declare(strict_types=1);

namespace App\Service\NotificationSender\Config;

use App\Exceptions\NotificationsSender\SenderClassNotFoundException;
use App\Exceptions\NotificationsSender\SenderTypeNotSupportedException;
use App\Exceptions\NotificationsSender\SendMethodNotFoundException;
use App\Services\NotificationSender\Senders\SMSSender;
use App\Services\NotificationSender\Senders\EmailSender;

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
