<?php

namespace App\Domains\Product\Queries;

use App\Models\Product;

class ProductSimpleQuery
{
    private string $productId;

    public function __construct(string $productId)
    {
        $this->productId = $productId;
    }

    //
    public function getData(): array
    {
        $product = Product::findOrFail($this->productId);

        return $product->toArray();
    }
}
