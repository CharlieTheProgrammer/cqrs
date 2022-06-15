<?php

namespace App\Domains\Product\Commands;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

/**
 * Don't get confused by the terminology.
 * Command = Write Model
 */
class CreateProductCommand implements Arrayable
{
    private string $id;

    public function __construct(
        private string $name,
        private string $price,
    ) {
        $this->id = Str::uuid();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string | null
    {
        return $this->name;
    }

    public function getPrice(): string | null
    {
        return $this->price;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price
        ];
    }
}
