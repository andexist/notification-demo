<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Exception\JsonParsingException;
use App\Exception\NotificationsSender\EmptyNotificationJsonDataValueException;
use App\Exception\NotificationsSender\MissingNotificationJsonDataKeyException;
use App\Model\Message;
use Symfony\Component\Serializer\SerializerInterface;

class NotificationSerializer
{
    public function __construct(private SerializerInterface $serializer) 
    {}

    public function serialize(Message $message): string
    {
        return $this->serializer->serialize($message, 'json');
    }

    public function deserialize(string $data): Message
    {
        $decodedData = json_decode($data, true);

        if (null === $decodedData) {
            throw new JsonParsingException();
        }

        if (!isset($decodedData['body'])) {
            throw new MissingNotificationJsonDataKeyException();
        }

        if (empty($decodedData['body'])) {
            throw new EmptyNotificationJsonDataValueException();
        }

        return $this->serializer->deserialize(json_encode($decodedData['body']), Message::class, 'json');
    }
}
