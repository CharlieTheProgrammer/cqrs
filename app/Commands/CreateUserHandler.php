<?php

namespace App\Commands;

use App\Models\User;

/**
 * There is a rule here. One command must have exactly one CommandHandler
 * Don't get confused by the terminology.
 * Handler = Action for Write Model/Command
 */
class CreateUserHandler
{
    // __invoke allows class to be called as a function.
    public function __invoke(CreateUserCommand $command)
    {
        // Business rules here
        $user = new User();
        $user->id = $command->getId();
        $user->firstName = $command->getFirstName();
        $user->lastName = $command->getLastName();
        $user->save();
        return $user;
    }
}

