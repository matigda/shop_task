<?php
declare(strict_types = 1);

namespace Infrastructure\RabbitMQ;

use Infrastructure\Mailer\MailerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;

class ProductAddedConsumer implements ConsumerInterface
{
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(MailerInterface $mailer, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(AMQPMessage $msg)
    {
        try {
            $this->logger->info('Message received');

            $content = $this->getContent($msg);

            $this->mailer->sendMailAboutNewProduct($content['productId']);

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }

    private function getContent(AMQPMessage $msg)
    {
        return json_decode($msg->getBody(), true);
    }
}
