<?php

namespace App\Domains\User\Queries;

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
        // Currently, this is relying on Laravel's Eloquent ORM for fetching data.
        // By abstracting this away to a repository, I can worry less about how the data is fetched.
        // That would help in the event I want to swap out datastores. For example,
        // I can start off my reading events from Mysql and that works because I'm using Laravel's Eloquent ORM.
        // But what if I want to switch over to Redis? I can't do that without re-writing all
        // the query files because Eloquent can't interact with Redis the same way it can with a SQL DB.
        // The inverse is also true. I could start off with Redis, but maybe later want to read from
        // materialized views in SQL.
        // I will be able to do both a lot easier if there's a layer of abstraction.
        $user = User::findOrFail($this->userId);
        return $user->toArray();
    }
}
