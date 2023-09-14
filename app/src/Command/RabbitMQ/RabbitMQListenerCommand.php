<?php

namespace App\Command\RabbitMQ;

use App\QueueClient\RabbitMQ\RabbitMQClientInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'rabbitmq:listen',
    description: 'Listens to RabbitMQ events',
)]
class RabbitMQListenerCommand extends Command
{
    private static $queueName = 'low';

    public function __construct(private RabbitMQClientInterface $rabbitMQClient)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        $this->rabbitMQClient->consumeFromQueue(self::$queueName, $callback);

        return Command::SUCCESS;
    }
}
