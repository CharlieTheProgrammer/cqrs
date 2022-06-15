<?php

namespace App\Http\Controllers;

use App\CommandBus;
use App\Domains\User\Commands\CreateUserCommand;
use App\Domains\User\Commands\UpdateUserCommand;
use App\Domains\User\Queries\UserAddressQuery;
use App\Domains\User\Queries\UserContactQuery;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(private CommandBus $commandBus) {}

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

    // Actions here
    public function showUser(string $id)
    {
        $query = new UserAddressQuery($id);
        return $query->getData();
    }

    public function showUserAddresses(string $id)
    {
        $query = new UserAddressQuery($id);
        return $query->getData();
    }

    public function showUserContacts(string $id)
    {
        $query = new UserContactQuery($id);
        return $query->getData();
    }

    // Update
    public function update(Request $request)
    {
        $command = new UpdateUserCommand(...$request->all(['id', 'firstName', 'lastName', 'addresses', 'contacts']));
        $this->commandBus->handle($command);

        return response()->json([
            'message' => 'success',
            'user' => $command->toArray()
        ]);
    }
}
