<?php
declare(strict_types = 1);

namespace Domain\Command;

class CreateProductCommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $price;

    public function __construct(string $name, string $description, int $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
