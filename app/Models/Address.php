<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Laravel assumes PK is an auto-incrementing integer. This means toArray returns 0.
    // Overriding because I'm using UUID
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillables = ['id', 'address_line_1', 'city', 'state', 'postal_code'];

    // TODO: Temporary workaround. I'm getting an error stating id is not fillable, even though it's in the array.
    protected $guarded = false;

}
