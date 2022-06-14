<?php

namespace App\Commands;

use App\Models\Product;

/**
 * There is a rule here. One command must have exactly one CommandHandler
 * Don't get confused by the terminology.
 * Handler = Action for Write Model/Command
 */
class CreateProductHandler
{
    // __invoke allows class to be called as a function.
    public function __invoke(CreateProductCommand $command)
    {
        $product = Product::create($command->toArray());
        return $product;
    }
}
