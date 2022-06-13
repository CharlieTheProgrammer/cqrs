<?php

namespace App\Commands;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

/**
 * Don't get confused by the terminology.
 * Command = Write Model
 */
class CreateUserCommand implements Arrayable
{
    private string $id;
    private string $firstName;
    private string $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        $this->id = Str::uuid();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string | null
    {
        return $this->firstName;
    }

    public function getLastName(): string | null
    {
        return $this->lastName;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName
        ];
    }
}
