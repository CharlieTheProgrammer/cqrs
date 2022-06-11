<?php

namespace App\Commands;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

/**
 * Don't get confused by the terminology.
 * Command = Write Model
 */
class CreateProductCommand implements Arrayable
{
    private string $id;
    private string $name;
    private string $price;

    public function __construct(string $name, string $price)
    {
        $this->id = Str::uuid();
        $this->name = $name;
        $this->price = $price;
    }

    public function getid(): string
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

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price
        ];
    }
}
