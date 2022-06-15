<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

class Event implements Arrayable
{
    private string $eventId;
    private Carbon $eventDate;

    public function __construct(private string $eventName, private array $data)
    {
        $this->eventId = Str::uuid();
        $this->eventDate = now();
    }

    public function toArray(): array
    {
        return [
            'eventName' => $this->eventName,
            'eventId' => $this->eventId,
            'eventDate' => $this->eventDate->getTimestamp(),
            'data' => $this->data,
        ];
    }
}
