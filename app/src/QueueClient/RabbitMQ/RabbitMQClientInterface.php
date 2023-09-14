<?php

declare(strict_types=1);

namespace App\QueueClient\RabbitMQ;

use PhpAmqpLib\Channel\AMQPChannel;

interface RabbitMQClientInterface
{
    public function createChannel(): AMQPChannel;
    public function publishToQueue(string $queueName, string $message): void;
    public function consumeFromQueue(string $queueName, callable $callback): void;
    public function closeConnection(): void;
    public function closeChannel(): void;
}
