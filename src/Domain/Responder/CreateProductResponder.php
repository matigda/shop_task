<?php
declare(strict_types = 1);

namespace Domain\Responder;

use Domain\Entity\Product;

interface CreateProductResponder
{
    public function productCreated(Product $product);
}
