<?php

namespace App\Domains\User\Commands;

use App\Domains\User\Commands\Address as CommandsAddress;
use App\Domains\User\Commands\Contact as CommandsContact;
use App\Models\Address;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * There is a rule here. One command must have exactly one CommandHandler
 * Don't get confused by the terminology.
 * Handler = Action for Write Model/Command
 */
class UpdateUserHandler
{
    // __invoke allows class to be called as a function.
    public function __invoke(UpdateUserCommand $command)
    {
        // In this case, we are taking in an object
        // User with addresses and contacts and updating those in the system
        DB::transaction(function() use($command) {
            // Save the User
            $user = User::findOrFail($command->getId());
            $user->firstName = $command->getFirstName();
            $user->lastName = $command->getLastName();
            $user->save();

            // Save the addresses
            $addresses = $this->handleUserAddresses($command->getAddresses());
            // This is giving me a weird error: "Add [id] to fillable property to allow mass assignment on [App\\Models\\Address].",
            // However, id is listed in the fillable property of the address model.
            Arr::map($addresses, fn($address) => $user->addresses()->updateOrCreate(['id' => $address->id], $address->toArray()));

            // Save the contacts
            $contacts = $this->handleUserContacts($command->getContacts());
            Arr::map($contacts, fn($contact) => $user->contacts()->updateOrCreate(['id' => $contact->id], $contact->toArray()));

            // Note that returning anything is optional in CQRS
        });
    }

    private function handleUserAddresses(array $commandAddresses): array
    {
        $addresses = [];
        foreach($commandAddresses as $commandAddress) {
            $address = $this->handleAddress($commandAddress);
            array_push($addresses, $address);
        }
        return $addresses;
    }

    private function handleAddress(CommandsAddress $commandAddress): Address
    {
        $address = new Address();
        $address->id = $commandAddress->getId();
        $address->address_line_1 = $commandAddress->getAddressLine1();
        $address->city = $commandAddress->getCity();
        $address->state = $commandAddress->getState();
        $address->postal_code = $commandAddress->getPostalCode();
        return $address;
    }

    private function handleUserContacts(array $commandContacts): array
    {
        $contacts = [];
        foreach($commandContacts as $commandContact) {
            $contact = $this->handleContact($commandContact);
            array_push($contacts, $contact);
        };
        return $contacts;
    }

    private function handleContact(CommandsContact $commandContact): Contact
    {
        $contact = new Contact();
        $contact->id = $commandContact->getId();
        $contact->type = $commandContact->getType();
        $contact->details = $commandContact->getDetails();
        return $contact;
    }
}

