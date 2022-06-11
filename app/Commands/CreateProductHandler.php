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
        $product = new Product();
        $product->id = $command->getId();
        $product->name = $command->getName();
        $product->price = $command->getPrice();
        $product->save();
        return $product;
    }
}

