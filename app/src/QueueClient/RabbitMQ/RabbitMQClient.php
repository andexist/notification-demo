<?php

declare(strict_types=1);

namespace App\QueueClient\RabbitMQ;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

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

     public function publishToQueue(string $queueName, string $message): void
     {
          $channel = $this->createChannel();
          $channel->queue_declare($queueName, false, true, false, false);

          $msg = new AMQPMessage($message);

          $channel->basic_publish($msg, '', $queueName);
          $this->closeChannel();
     }

     public function consumeFromQueue(string $queueName, callable $callback): void
     {
          $channel = $this->createChannel();
          $channel->queue_declare($queueName, false, true, false, false);
          
          $channel->basic_qos(null, 1, null);
          $channel->basic_consume(
               $queueName,
               '',
               false,
               false,
               false,
               false,
               $callback
          );

          while (count($channel->callbacks)) {
               $channel->wait();
           }

          $this->closeChannel();
     }

     public function closeConnection(): void
     {
          $this->closeChannel();

          if ($this->connection->isConnected()) {
               $this->connection->close();
          }
     }

     public function closeChannel(): void
     {
          if ($this->channel !== null && $this->channel->is_open()) {
               $this->channel->close();
          }
     }
}
