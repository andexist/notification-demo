<?php

declare(strict_types=1);

namespace App\QueueClient\RabbitMQ;

use PhpAmqpLib\Channel\AMQPChannel;

interface RabbitMQClientInterface
{
    public function createChannel(): AMQPChannel;
    public function closeConnection();
    public function closeChannel();
}
