<?php

namespace App\Domains\User\Events;

use App\Domains\User\Commands\CreateUserCommand;
use App\Event;


class UserCreatedEvent extends Event
{
    public function __construct(private CreateUserCommand $command)
    {
        // There's probably a shortcut I can implement here
        parent::__construct('UserCreatedEvent', $command->toArray());
    }
}
