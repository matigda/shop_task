<?php
declare(strict_types = 1);

namespace Domain\Storage;

use Domain\Entity\Product;

interface ProductStorage
{
    public function saveProduct(Product $product);
}
