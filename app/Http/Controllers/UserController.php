<?php

namespace App\Http\Controllers;

use App\CommandBus;
use App\Commands\CreateUserCommand;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    // Create
    public function create(Request $request)
    {
        // Extract certain attributes out of the request.
        ['firstName' => $firstName, 'lastName' => $lastName] = $request->only(['firstName', 'lastName']);

        $command = new CreateUserCommand($firstName, $lastName);
        $this->commandBus->handle($command);

        return response()->json([
            'message' => 'success',
            'user' => $command->toArray()
        ]);
    }

}
