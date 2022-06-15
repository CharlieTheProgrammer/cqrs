<?php

namespace App\Domains\User\Queries;

use App\Models\User;

/**
 * This is where I get to define the UserAddress model.
 * I can return an address or a nested object with User and then the addresses
 */
class UserAddressQuery
{
    private string $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    // Return the user's addresses
    public function getData(): array
    {
        $addresses = User::findOrFail($this->userId)->addresses;
        return $addresses->toArray();
    }
}
