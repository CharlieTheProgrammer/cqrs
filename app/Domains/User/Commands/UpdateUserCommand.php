<?php

namespace App\Domains\User\Commands;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Don't get confused by the terminology.
 * Command = Write Model
 */
class UpdateUserCommand implements Arrayable
{
    // We need classes for these two below.
    private array $addresses;
    private array $contacts;

    public function __construct(
        private string $id,
        private string $firstName,
        private string $lastName,
        array $addresses,
        array $contacts
    ) {
        // Iterate over addresses and contacts.
        // If they are missing an id create one.
        $this->addresses = $this->handleAddresses($addresses);
        $this->contacts = $this->handleContacts($contacts);
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
        return $this->firstName;
    }

    public function getAddresses(): array
    {
        return  $this->addresses;
    }

    public function getContacts(): array
    {
        return $this->contacts;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'addresses' => Arr::map($this->addresses, fn ($item) => $item->toArray()),
            'contacts' => Arr::map($this->contacts, fn ($item) => $item->toArray()),

        ];
    }

    private function handleAddresses($addresses = []): array
    {
        $newAddresses = [];
        foreach ($addresses as $key => $address) {
            array_push($newAddresses, new Address(...$address));
        }

        return $newAddresses;
    }

    private function handleContacts($contacts = []): array
    {
        foreach ($contacts as $key => $contact) {
            $contacts[$key] = new Contact(...$contact);
        }
        return $contacts;
    }
}

class Address implements Arrayable
{
    private string $id;

    public function __construct(
        private string $addressLine1,
        private string $city,
        private string $state,
        private int $postalCode,
        $id = null
    ) {
        $this->id = $id ?? Str::uuid();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    public function getCity()
    {
        return $this->city;
    }


    public function getState()
    {
        return $this->state;
    }


    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'addressLine1' => $this->addressLine1,
            'city' => $this->city,
            'state' => $this->state,
            'postalCode' => $this->postalCode,
        ];
    }
}

class Contact implements Arrayable
{
    private string $id;

    public function __construct(private string $type, private string $details, $id = null)
    {
        $this->id = $id ?? Str::uuid();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'details' => $this->details,
        ];
    }
}
