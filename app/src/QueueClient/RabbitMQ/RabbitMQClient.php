<?php

declare(strict_types=1);

namespace App\QueueClient\RabbitMQ;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQClient implements RabbitMQClientInterface
{
     private AMQPStreamConnection $connection;
     private ?AMQPChannel $channel = null;

     public function __construct(string $host, int $port, string $user, string $password, string $vhost)
     {
          $this->connection = new AMQPStreamConnection($host, $port, $user, $password, $vhost);
     }

     public function createChannel(): AMQPChannel
     {
          if ($this->channel === null || !$this->channel->is_open()) {
               $this->channel = $this->connection->channel();
          }

          return $this->channel;
     }

     public function closeConnection()
     {
          $this->closeChannel();

          if ($this->connection->isConnected()) {
               $this->connection->close();
          }
     }

     public function closeChannel()
     {
          if ($this->channel !== null && $this->channel->is_open()) {
               $this->channel->close();
          }
     }
}
