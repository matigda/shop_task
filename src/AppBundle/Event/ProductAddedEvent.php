<?php
declare(strict_types = 1);

namespace AppBundle\Event;

use Domain\Entity\Product;
use Symfony\Component\EventDispatcher\Event;

class ProductAddedEvent extends Event
{
    /**
     * @var Product
     */
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
