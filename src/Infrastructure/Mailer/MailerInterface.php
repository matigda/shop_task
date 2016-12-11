<?php
declare(strict_types = 1);

namespace Infrastructure\Mailer;

interface MailerInterface
{
    public function sendMailAboutNewProduct(string $productId);
}
