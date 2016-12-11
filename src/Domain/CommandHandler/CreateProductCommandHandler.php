<?php
declare(strict_types = 1);

namespace Domain\CommandHandler;

use Domain\Command\CreateProductCommand;
use Domain\Entity\Product;
use Domain\Responder\CreateProductResponder;
use Domain\Storage\ProductStorage;
use Ramsey\Uuid\Uuid;

class CreateProductCommandHandler
{
    /**
     * @var ProductStorage
     */
    private $productStorage;

    public function __construct(ProductStorage $productStorage)
    {
        $this->productStorage = $productStorage;
    }

    public function execute(CreateProductCommand $command, CreateProductResponder $responder)
    {
        $product = new Product(
            Uuid::uuid4()->toString(),
            $command->getName(),
            $command->getDescription(),
            $command->getPrice()
        );

        $this->productStorage->saveProduct($product);

        $responder->productCreated($product);
    }
}
