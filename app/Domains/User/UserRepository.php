<?php

namespace App\Domains\User;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

/**
 * The purpose of this class is to create a level of abstraction over the read model
 * so that I can switch this out if needed. Recall that projectors will be respons
 *
 * The methods should be comprised of actions
 */
class EventStore
{
    // Write event
    public function writeEvent()
    {

    }
}
