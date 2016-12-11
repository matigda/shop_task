<?php
declare(strict_types = 1);

namespace Infrastructure\Storage;

use Doctrine\Common\Persistence\ObjectManager;
use Domain\Entity\Product;
use Domain\Storage\ProductStorage;

class DoctrineStorage implements ProductStorage
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function saveProduct(Product $product)
    {
        $this->objectManager->persist($product);
        $this->objectManager->flush();
    }
}
