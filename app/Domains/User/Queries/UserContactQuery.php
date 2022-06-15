<?php

namespace App\Domains\User\Queries;

use App\Models\User;

/**
 * Another thing we can do here is not return all the columns.
 */
class UserContactQuery
{
    private string $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    // Return the user's contacts
    public function getData(): array
    {
        $contacts = User::findOrFail($this->userId)->contacts;
        return $contacts->toArray();
    }
}
