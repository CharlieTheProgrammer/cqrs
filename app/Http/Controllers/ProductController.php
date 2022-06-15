<?php

namespace App\Http\Controllers;

use App\CommandBus;
use App\Domains\Product\Commands\CreateProductCommand;
use App\Domains\Product\Queries\ProductSimpleQuery;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private CommandBus $commandBus;

    // Dependency Injection
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    // Write to the Command/write model
    public function create(Request $request)
    {
        ['name' => $name, 'price' => $price] = $request->only(['name', 'price']);
        $command = new CreateProductCommand($name, $price);
        $this->commandBus->handle($command);
        // Note that in this case, the write model is not synchronous.
        // Therefore, there is no incrementing PK id.
        // Instead, a uuid is created at object instantiation.
        // That id is then stored in the database along with the other attributes.
        return response()->json([
            'message' => 'success',
            'product' => $command->toArray()
        ]);
    }

    // Read from the read model, which is just the ProductModel
    public function details(Request $request)
    {
        // The reason why this layer of abstraction exists is because with CQRS,
        // the object we are returning may not neatly map 1:1 with DB table.
        // In fact, product may be comprised of many different db tables.
        // This is closer to returning a DTO rather than a model directly.
        $query = new ProductSimpleQuery($request->id);
        return $query->getData();
    }
}
