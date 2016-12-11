<?php
declare(strict_types = 1);

namespace Infrastructure\Mailer;

use Swift_Message;
use Swift_Mailer;

class Mailer implements MailerInterface
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMailAboutNewProduct(string $productId)
    {
        $message = Swift_Message::newInstance('Wonderful Subject')
            ->setFrom(['john@doe.com' => 'John Doe'])
            ->setBody(sprintf('Product with id "%s" has been added.', $productId))
        ;

        $this->mailer->send($message);
    }
}
