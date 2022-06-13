<?php

namespace App\Queries;

use App\Models\User;

/**
 * Another thing we can do here is not return all the columns.
 */
class UserQuery
{
    private string $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    // Return the user
    public function getData(): array
    {
        $user = User::findOrFail($this->userId);
        return $user->toArray();
    }
}
