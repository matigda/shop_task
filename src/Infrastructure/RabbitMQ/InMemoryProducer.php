<?php
declare(strict_types = 1);

namespace Infrastructure\RabbitMQ;

use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

class InMemoryProducer implements ProducerInterface
{
    private $messages = [];

    /**
     * {@inheritdoc}
     */
    public function publish($msgBody, $routingKey = '', $additionalProperties = array())
    {
        $this->messages[] = [
            'body' => $msgBody,
            'routingKey' => $routingKey
        ];
    }

    public function getMessages()
    {
        return $this->messages;
    }
}
