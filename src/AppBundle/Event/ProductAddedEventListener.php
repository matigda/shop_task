<?php
declare(strict_types = 1);

namespace AppBundle\Event;

use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

class ProductAddedEventListener
{
    /**
     * @var ProducerInterface
     */
    private $producer;

    public function __construct(ProducerInterface $producer)
    {
        $this->producer = $producer;
    }

    public function onProductAdded(ProductAddedEvent $event)
    {
        $message = json_encode(['productId' => $event->getProduct()->getId()]);
        $this->producer->publish($message, 'product.added');
    }
}
